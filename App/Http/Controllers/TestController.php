<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 16:47
 */
class TestController extends BaseController {
    public function index(){
        echo "<center><h3>Welcome to simpleEfficient！</h3></center><br />";
        echo "<center> A framework for beginners to learn </center>";
        echo "<center> Its birth is convenient for your warmth and new knowledge </center>";

    }

    public function test()
    {
        dd(22);
    }
}