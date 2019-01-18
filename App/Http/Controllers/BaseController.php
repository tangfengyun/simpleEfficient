<?php
/**
 * 基础控制器
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/17
 * Time: 10:45
 * desc: 存放控制器一些公共的方法
 */
class BaseController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->initSession();
    }

    /**
     * 开启session
     */
    protected function initSession()
    {
        //先显式的调用父类方法
        parent::__construct();
        //再进行判断
        $this->check();
    }

    /**
     * 判断用户是否登录动作
     */
    private function check(){
        //先列出不需要判断的界面
        //不需要验证的参数$no_ckeck
        $no_check = array(
            'Admin'=>array('login','captcha','check'),
        );
        if(isset($no_check[CONTROLLER])&&in_array(ACTION, $no_check[CONTROLLER])){
            //说明当前控制器下的动作不需要验证
            return;
        }
        //开始session
        @session_start();
        if(!isset($_SESSION['adminInfo'])){
            $this->jump('index.php?p=Back&c=Admin&a=login',':(请先登录！');
        }
    }


}