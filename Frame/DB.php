<?php
/**
 * 项目中的单例工厂(model)
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 9:40
 */
class DB {
    //生成模型类的单例对象
    public static function table($class_name)
    {
        // 定义静态变量,用于保存已经实例化好了对象列表
        // 下标是类名,值是类的对象
        static $model_list = array();
        // 判断当前模型是否被实例化
        if(! isset($model_list[$class_name])){
            // 没有实例化
            $model_list[$class_name] = new  $class_name;
        }

        return $model_list[$class_name];
    }
}