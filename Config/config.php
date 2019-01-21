<?php

return array(
//	'db'	=>	array( // 数据库信息组(service)
//		'host'	=>	'bdm263683440.my3w.com',
//		'port'	=>	'3306',
//		'user'	=>	'bdm263683440',
//		'pass'	=>	'FengYun15211026204',
//		'charset'=>	'utf8',
//		'dbname' => 'bdm263683440_db'
//	),
    'db'	=>	array( // 数据库信息组(local)
        'host'	=>	'localhost',
        'port'	=>	'3306',
        'user'	=>	'root',
        'pass'	=>	'',
        'charset'=>	'utf8',
        'dbname' => 'blog'
    ),
    'App'	=>	array( // 应用程序组
        'default_platform'=>'Back',
        'dao'	=>	'mysql',// 这里可以是pdo或mysql
    ),
    'Home'	=>	array( // 前台组
        'default_controller'=>'Index',
        //'default_controller'=>'default',
        'default_action'	=>'index'
    ),
    'Back'	=>	array(	// 后台组
        'default_controller'=>'Admin',
        'default_action'	=>'login'
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

