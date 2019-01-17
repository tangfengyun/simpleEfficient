<?php
/**
 * 路由
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/17
 * Time: 11:44
 */
namespace Frame\Route;
class Route{

    private $_listener = array();

    public function __construct()
    {
        $this->RouteHook();
    }

    public static function get($route_name,$func_name)
    {


    }

    public static function post($route)
    {

    }
}