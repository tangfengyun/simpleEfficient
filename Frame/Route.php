<?php
/**
 * 路由
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/17
 * Time: 11:44
 */
class Route{

    public $con;
    public $act;


    public function __construct(){


        if (isset($_SERVER['PATH_INFO'])) {
            if ($_SERVER['PATH_INFO'] != "" && $_SERVER['PATH_INFO'] != "/") {

                $PATH=trim($_SERVER['PATH_INFO'],"/");

                $PATH_ARR=explode("/", $PATH);

                $this->con=isset($PATH_ARR[0])?$PATH_ARR[0]:$_SERVER['config'][PLATFORM]['default_controller'];
                $this->act=isset($PATH_ARR[1])?$PATH_ARR[1]:$_SERVER['config'][PLATFORM]['default_action'];


                unset($PATH_ARR[0]);
                unset($PATH_ARR[1]);


                $num = count($PATH_ARR)+2;


                for ($i=2; $i <$num; $i++) {
					if (isset($PATH_ARR[$i+1])) {
                        $_GET[$PATH_ARR[$i]]=$PATH_ARR[$i+1];
                    }
					$i++;


				}


            }
        }else{


            $this->con=$_SERVER['config'][PLATFORM]['default_controller'];
            $this->act=$_SERVER['config'][PLATFORM]['default_action'];


        }

    }
}