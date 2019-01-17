<?php
return array(
    'db'	=>	array( // 数据库信息组(local)
        'host'	=>	'localhost',
        'port'	=>	'3306',
        'user'	=>	'root',
        'pass'	=>	'',
        'charset'=>	'utf8',
        'dbname' => 'blog'
    ),
    'App' => array(
        'default_platform' => 'Home',
        'dao'	=>	'pdo',// 这里可以是pdo或mysql
    ),
    'Home' => array(
        'default_controller' => 'Test',//Index
        'default_action' => 'index',
    ),
    'Back' => array(
        'default_controller' => 'Admin',
        'default_action' => 'login',
    ),
    'Captcha' => array(//验证码信息组
        'width'     => 80, //宽
        'height'    => 32,  //高
        'pixelnum'  => 0.03,  //干扰点数
        'linenum' 	=> 5,  //干扰线
        'stringnum' => 4,  //验证码字符个数
    ),
    'Page'  => array(//分页信息组
        'rowsPerPage'=>3,  //每页显示的记录数
        'maxNum' => 5  //页面上能够显示最多有多少页面
    ),
);