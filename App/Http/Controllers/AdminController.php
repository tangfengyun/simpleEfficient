<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/18
 * Time: 10:41
 */
class AdminController extends BaseController{

    /**
     * 展示登录表单动作
     */
    public function login()
    {
        // 载入当前的视图文件
       $this->view('login');
    }

    /**
     * 验证管理员的合法性
     */
    public function check()
    {
        //接收前端数据
        $admin_name = $this->escapeData($_POST['admin_name']);
        $admin_pass = $_POST['admin_pass'];
        $passcode = trim($_POST['passcode']);

        //验证是否合法
        $captcha = DB::table('Captcha');
        if(! $captcha->checkCaptcha($passcode)){
            $this->jump('index.php?p=Back&c=Admin&a=login',':(验证码错误！');
        }


        $admin = DB::table('adminModel');
        if($row = $admin->check($admin_name,$admin_pass)){
            @session_start();
            $_SESSION['adminInfo'] = $row;
            $admin->updateAdminInfo($row['admin_id']);
            $this->jump('index.php?p=Back&c=Manage&a=index');
        }else{
            $this->jump('index.php?p=Back&c=admin&a=login');
        }

        
     }

    /**
     * 生成验证码动作
     */
    public function captcha()
    {
        $captcha=DB::table('Captcha');
        $captcha->generate();
     }


    /**
     * 后台注销功能
     */
    public function logout(){
        //开启session机制
        @session_start();
        //删除管理员相关信息
        unset($_SESSION['adminInfo']);
        //删除数据会话区
        session_destroy();
        //立即跳转至登录界面
        $this->jump('index.php?p=Back&c=Admin&a=login');
    }

    public function index(){
        var_dump(2223223);
    }
}