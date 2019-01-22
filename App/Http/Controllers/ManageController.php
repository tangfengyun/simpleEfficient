<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/21
 * Time: 11:41
 */

class ManageController extends BaseController {
    public function index(){
        $this->view('index');
    }

    /**
     * 判断管理员是否登录
     */
    public function checkLogin(){
        //开启session
        session_start();
        //如果没开登录，直接跳转至login界面
        if(!isset($_SESSION['adminInfo'])){
            $this->jump('index.php?p=Back&c=Admin&a=login',':(登录失败!');
        }
    }
}