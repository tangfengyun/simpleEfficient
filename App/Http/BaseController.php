<?php
/**
 * 基础控制器
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 10:30
 * desc: 存放控制器一些公共的方法
 */
class BaseController extends Controller{

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
        @session_start();
    }
}