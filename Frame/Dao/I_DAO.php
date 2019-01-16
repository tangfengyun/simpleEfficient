<?php
/**
 * DAO层操作接口
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 11:14
 */
namespace Frame\Dao;
interface  I_DAO {

    public static function getInstance($config);
    public function my_query($sql);
    public function fetchAll($sql);
    public function fetchRow($sql);
    public function fetchColumn($sql);
}