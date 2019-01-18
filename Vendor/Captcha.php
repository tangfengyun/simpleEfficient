<?php
/**
 * 封装一个验证码类
 */
class Captcha{
	/**
	 * 定义相关属性
	 */
	private $width; //宽
	private $height;  //高
	private $pixelnum;  //干扰点密度
	private $linenum; //干扰点数量
	private $stringnum;  //验证码字符个数
	private $string; //要写入的随机字符串
	/**
	 * 构造方法
	 */
	public function __construct(){
		$this->initParams(); //自动调用
	}
	/**
	 * 初始化相关属性
	 */
	private function initParams(){
		//在配置文件conf.php中查找
		$this->width = $GLOBALS['config']['Captcha']['width'];
		$this->height = $GLOBALS['config']['Captcha']['height'];
		$this->pixelnum = $GLOBALS['config']['Captcha']['pixelnum'];
		$this->linenum = $GLOBALS['config']['Captcha']['linenum'];
		$this->stringnum = $GLOBALS['config']['Captcha']['stringnum'];
	}
	/**
	 * 生成图片
	 */
	public function generate(){
		//创建画布
		$image = imagecreate($this->width, $this->height);
		//创建画笔
		$background = imagecolorallocate($image,  mt_rand(200,255),mt_rand(150,200),mt_rand(233,255));
		//填充背景色
		imagefill($image, 0, 0, $background);
		//随机产生验证码字符串
		$stringnum = $this->getRandString();
		//计算字间距颜色
		$span = floor($this->width/($this->stringnum+1));
		//设置字符串颜色
		
		for($i=1;$i<=$this->stringnum;$i++){
			$stringColor = imagecolorallocate($image, mt_rand(0,255), mt_rand(0,100), mt_rand(0,60));
			imagestring($image, 5, $i*$span, ($this->height/2)-6, $stringnum[$i-1], $stringColor);
		}
		//添加干扰线
		for($i=1;$i<=$this->linenum;$i++){
			$lineColor = imagecolorallocate($image, mt_rand(0,150), mt_rand(30,250), mt_rand(200,255));
			$x1 = mt_rand(0,$this->width-1);
			$y1 = mt_rand(0,$this->height-1);
			$x2 = mt_rand(0,$this->width-1);
			$y2 = mt_rand(0,$this->height-1);
			imageline($image,$x1,$y1,$x2,$y2, $lineColor);
		}
		// //添加干扰点
		for($i=1;$i<=$this->width*$this->height*$this->pixelnum;$i++){
			$pixeColor = imagecolorallocate($image, mt_rand(100,150), mt_rand(0,120), mt_rand(0,255));
			imagesetpixel($image, mt_rand(0,$this->width-1), mt_rand(0,$this->height-1), $pixeColor);
		}
		//输出图片
		header("Content-type:image/png");
		//清除缓存数据
		ob_clean();
		// imagepng($image);
		//输出验证码
		$outIdentify = imagepng($image);
		
	}
	private function getRandString(){
		//随机产生验证码字符串
		$arr= array_merge(range(0, 9),range('a', 'z'),range('A', 'Z'));
		//打乱随机字符串
		shuffle($arr);
		//随机验证个数
		$rand_keys = array_rand($arr,$this->stringnum);
		//保存验证数
		$str = '';
		foreach ($rand_keys as $value){
			$str .= $arr[$value];
		}
		//保存到session变量中
		@session_start();
		$_SESSION['captcha'] =$str;
		return $str;
	}
	/**
	 * 检测验证码公开的方法
	 */
	public function checkCaptcha($passcode){
		//开启session
		@session_start();
		//判断传值passcode是否与session中一致
		if(strtolower($passcode)!==strtolower($_SESSION['captcha'])){
			return false;
		}else{
			return true;
		}
	}
}