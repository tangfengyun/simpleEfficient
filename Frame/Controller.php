<?php
/**
 * 基础控制器类
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 9:44
 */
include_once '../vendor/autoload.php';
class Controller {

    // 定义一个属性,用于保存Smarty对象
    protected  $smarty;
    // 定义一个属性,用于保存Smarty对象
    protected  $twig;

    /**
     *构造方法
     */
    public function __construct()
    {
        //初始化文件编码
        $this->initCode();
        //初始化smarty模板
        $this->initSmarty();
        //初始化twig
        $this->initTwig();
    }

    /**
     * 初始化文件编码
     */
    protected function initCode()
    {
        header('Content-type:text/html;Charset=utf-8');
    }

    /**
     * 初始化Smarty
     */
    protected function initSmarty()
    {
        // 实例化Smarty
        $this->smarty = new Smarty();
        // 设置模板路径
        $this->smarty->setTemplateDir(CURRENT_RESOURCE_DIR . CONTROLLER . '/');
        // 设置编译文件路径
        $this->smarty->setCompileDir(ROOT_DIR .'Resources/Views_c/' . CONTROLLER . '/');

    }

    /**
     * 初始化twig
     */
    function initTwig()
    {
        // 实例化Twig 适用于1.0版
        //\Twig_Autoloader::register();
        // 设置模板路径
        $loader = new Twig_Loader_Filesystem(CURRENT_RESOURCE_DIR . CONTROLLER . '/');
        // 设置编译文件路径
        $this->twig = new Twig_Environment($loader, array(
            'View_c' => ROOT_DIR .'Resources/Views_c/' . CONTROLLER . '/',
        ));


    }

    /**
     * smarty视图模板数据输出
     * @param $view_name [eg:admin]
     * @param $data
     */
    protected function view($view_name ,$data = array())
    {
        // 调用smarty数据填充
        if(isset($data)){
            foreach ($data as $name=> $value){
                //对用户递交数据进行安全过滤
                //$value = $this->escapeData($value);
                // 调用smarty对象的assign方法
                $this->smarty->assign($name,$value);
            }
        }
        // 调用smarty对象的display方法
        $name = $view_name . '.html';
        $this->smarty->display($name);
    }

    /**
     * twig视图模板数据输出
     * @param string $view_name
     * @param array $data
     */
    protected function show( $view_name='' ,$data = array())
    {
         $name = $view_name . '.html';
         echo $this->twig->render($name,$data);
    }

    /**
     * 增加一个跳转方法
     *@param string $url 跳转的地址
     *@param string $info 跳转错误的提示信息
     *@param time  $time 等待的时间，跳转的时间（单位秒）
     */
    protected function jump($url,$info=null,$time=3)
    {
        if(is_null($info)){
            header('location:'.$url);
            die;
        }else{
            //刷新跳转给出提示
            //直接跳转模板
            echo <<<wrongInfo
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>提示信息</title>
    <style type='text/css'>
        * {margin:0; padding:0;}
        div {width:390px; height:287px; border:1px #09C solid; position:absolute; left:50%; margin-left:-195px; top:10%;}
        div h2 {width:100%; height:30px; line-height:30px; background-color:#09C; font-size:14px; color:#FFF; text-indent:10px;}
        div p {height:120px; line-height:120px; text-align:center;}
        div p strong {font-size:26px;}
    </style>
	<div>
        <h2>提示信息</h2>
        <p>
            <strong>$info</strong><br />
			页面在<span id="second">$time</span>秒后会自动跳转，或点击<a id="tiao" href="$url">立即跳转</a>
        </p>
    </div>
    <script type="text/javascript">
        var url = document.getElementById('tiao').href;
        function daoshu(){
            var scd = document.getElementById('second');
            var time = --scd.innerHTML;
            if(time<=0){
                window.location.href = url;
                clearInterval(mytime);
            }
        }
        var mytime = setInterval("daoshu()",1000);
    </script>
wrongInfo;
            exit;
        }
    }

    /**
     * 对用户递交数据进行安全过滤
     * @param $params
     * @return string
     */
    protected function escapeData($params){
        return addslashes(strip_tags(trim($params)));
    }


}