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
        'default_controller' => 'Index',
        'default_action' => 'index',
    ),
    'Back' => array(
        'default_controller' => 'Admin',
        'default_action' => 'login',
    ),
);