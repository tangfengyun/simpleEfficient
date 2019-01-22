<?php
/**
 * 框架初始化类
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/15
 * Time: 17:24
 */
class Frame
{
    /**
     * 项目入口方法
     */
    public static function run() {
        // 定义基础目录常量
        static::initConst();
        // 初始化配置
        static::initConfig();
        // 确定分发参数
        static::initDispatchParam();
        // 定义当前平台相关的目录常量
        static::initPlatformConst();
        // 注册自动加载方法
        static::initAutoload();
        // 请求分发
        static::initDispatch();
    }

    /**
     * 定义基础目录常量
     */
    private static function initConst()
    {
        define('ROOT_DIR', str_replace('Frame/Frame.php','',str_replace('\\', '/', __FILE__))); //根目录
        define('ROOT_DIR', str_replace('\\', '/', getcwd()) . '/'); // 根目录
        define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');  //应用目录
        define('APP_DIR',ROOT_DIR.'App/'); //应用程序目录
        define('CONFIG_DIR',ROOT_DIR.'Config/');//置文件目录
        define('FRAME_DIR',ROOT_DIR.'Frame/'); //框架目录
        define('PUBLIC_DIR',ROOT_DIR.'Public/');//公开目录
        define('RESOURCES_DIR',ROOT_DIR.'Resources/');//资源目录
        define('ROUTES_DIR',ROOT_DIR.'Routes/');//路由目录
        define('STORAGE_DIR',ROOT_DIR.'Storage/');//日志目录
        define('UPLOADS_DIR',ROOT_DIR.'Uploads/');//文件存放目录
        define('VENDOR_DIR',ROOT_DIR.'Vendor/');//第三方插件目录
        define('DAO_DIR',FRAME_DIR.'Dao/');//dao层目录(数据库)
        define('SMARTY_DIR',VENDOR_DIR.'Smarty/');//smarty目录
        define('TWIG_DIR',VENDOR_DIR.'twig/');//twig目录

    }

    /**
     * 初始化配置
     */
    private static function initConfig()
    {
        // 将配置文件存储到超全局变量中以便整个项目都可以使用
        $GLOBALS['config'] = include CONFIG_DIR.'config.php';

    }

    /**
     * 确定分发参数
     */
    private static function initDispatchParam()
    {
        //确定分发参数p(平台:前台&&后台)
        $default_platform = $GLOBALS['config']['App']['default_platform'];
        define('PLATFORM',isset($_GET['p']) ? $_GET['p'] : $default_platform);
        //确定分发参数c(控制器)
        $default_controller = $GLOBALS['config'][PLATFORM]['default_controller'];
        define('CONTROLLER',isset($_GET['c']) ? $_GET['c'] : $default_controller);
        //确定分发参数a(动作)
        $default_action = $GLOBALS['config'][PLATFORM]['default_action'];
        define('ACTION',isset($_GET['a']) ? $_GET['a'] : $default_action);
    }

    /**
     * 定义当前平台相关的目录常量
     */
    private static function initPlatformConst()
    {
        //控制器
        define('CURRENT_CONTROLLER_DIR',APP_DIR.'Http/Controllers/');
        //模型
        define('CURRENT_MODELS_DIR',APP_DIR.'Models/');
        //视图
        define('CURRENT_RESOURCE_DIR',ROOT_DIR.'Resources/Views/');

        // 以下的三个目录常量绝对路径
        define('CSS_DIR',  '/Resources/Public/' . PLATFORM . '/css');
        define('JS_DIR', '/Resources/Public/' . PLATFORM . '/js');
        define('IMAGES_DIR', '/Resources/Public/' . PLATFORM . '/images');
        define('UPLOAD_DIR', '/Uploads/Images');
    }

    /**
     * 实现类文件的加载方法
     */
    private static function autoload($class_name)
    {
        // 先把已经确定的核心类放到一个数组里面
        $frame_class_name = array(
            //'类名' => '类文件地址'
            'Controller'    =>  FRAME_DIR . 'Controller.php',
            'Model'         =>  FRAME_DIR . 'Model.php',
            'Upload'        =>  FRAME_DIR . 'Upload.php',
            'Page'          =>  FRAME_DIR . 'Page.php',
            'DB'            =>  FRAME_DIR . 'DB.php',
            'MYSQLDB'       =>  DAO_DIR . 'MYSQLDB.php',
            'PDODB'         =>  DAO_DIR . 'PDODB.php',
            'I_DAO'         =>  DAO_DIR . 'I_DAO.php',
            'Smarty'        =>  SMARTY_DIR . 'Smarty.class.php',
//            'Twig'          =>  VENDOR_DIR . 'autoload.php',
            'Captcha'       =>  VENDOR_DIR . 'Captcha.php',
        );

        // 判断是否为核心类
        if(isset($frame_class_name[$class_name])){
            include  $frame_class_name[$class_name];
        }
        // 判断是否为控制器类,截取后10个字符进行匹配
        elseif (substr($class_name,-10) == 'Controller'){
            include CURRENT_CONTROLLER_DIR . $class_name .'.php';
        }
        // 判断是否为模型类,截取后5个字符进行匹配
        elseif (substr($class_name,-5) == 'Model'){
            include CURRENT_MODELS_DIR . $class_name .'.php';
        }

    }

    /**
     * 注册自动加载方法
     */
    private static function initAutoload()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * 请求分发
     */
    private static function initDispatch()
    {
        // 先确定控制器类的名字
        $controller_name = CONTROLLER . 'Controller';
        // 实例化控制器类
        $controller = new $controller_name;
        // 先拼凑出当前方法的名字
        $action_name = ACTION;
        // 调用方法
        $controller->$action_name();// 可变方法
    }

   //TODO url跳转有待补充 v1.0.1

}