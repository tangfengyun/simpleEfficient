<?php
/**
 * model类
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 11:04
 */
namespace Frame;
class Model{

    // 定义用来存储dao对象的属性,要求可以在子类中被访问
    protected $dao;

    /**
     * 构造方法
     */
    public function __construct()
    {
        $this->initDAO();
    }

    /**
     * 初始化dao
     */
    protected function initDAO()
    {
        //初始化dao
        $config = $GLOBALS['config']['db'];
        // 根据配置文件,选择相应的数据库类文件
        switch ($GLOBALS['config']['App']['dao']){
            case 'pdo': $dao_class = 'PDODB';break;
            case 'mysql': $dao_class = 'MYSQLDB';break;
            default : $dao_class = 'PDODB';
        }
        $this->dao =  $dao_class::getInstance($config);
    }
}