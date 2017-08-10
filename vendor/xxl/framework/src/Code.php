<?php
namespace vendor;

class Code
{
	//图像的宽度
	protected $width;
	//图像的高度
	protected $height;
	//验证码的个数
	protected $number;
	//验证码的类型
	protected $type;
	//图像资源
	protected $image;
	//验证码字符串
	protected $code;
	
	function __construct($width = 100, $height = 50, $number = 4, $type = 2)
	{
		$this->width = $width;
		$this->height = $height;
		$this->number = $number;
		$this->type = $type;
		
		//只要创建对象，我就将验证码字符串给生成
		$this->code = $this->getCode();
	}
	
	//生成验证码字符串函数
	protected function getCode()
	{
		switch ($this->type) {
			case 0:  //纯数字
				$code = $this->getNumberCode();
				break;
			case 1:  //纯字母
				$code = $this->getCharCode();
				break;
			case 2:  //数字和字母
				$code = $this->getNumberCharCode();
				break;
			default:
				die('小伙子,我们这没有这种业务,你晚上11点之后再来');
		}
		return $code;
	}
	
	//生成纯数字验证码
	protected function getNumberCode()
	{
		for ($i = 0; $i < $this->number; $i++) {
			$arr[] = mt_rand(0, 9);
		}
		return join('', $arr);
	}
	
	protected function getCharCode()
	{
		$str = str_shuffle('abcdefghijklmnopqrstuvwxyzQWERTYUIOPSDFGHJKLZXCVBNM');
		return substr($str, 0, $this->number);
	}
	
	protected function getNumberCharCode()
	{
		$arr1 = range(0, 9);
		$arr2 = range('a', 'z');
		$arr3 = range('A', 'Z');
		$arr = array_merge($arr1, $arr2, $arr3);
		$str = join('', $arr);
		return substr(str_shuffle($str), 0, $this->number);
	}
	
	//只要外部调用这个方法，验证码图像立即给画出来
	public function outImage()
	{
		//创建画布
		$this->image = $this->createImage();
		//创建颜色  浅色 深色
		//填充背景色
		imagefill($this->image, 0, 0, $this->lightColor());
		//画验证码
		$this->drawCode();
		//画干扰元素
		$this->gan();  //铁道飞虎
		//输出图像
		header('content-type:image/png');
		imagepng($this->image);
		//销毁图像资源
	}
	
	protected function gan()
	{
		//计算干扰点的总个数
		$n = ($this->width * $this->height) / 20;
		for ($i = 0; $i < $n; $i++) {
			$x = mt_rand(0, $this->width);
			$y = mt_rand(0, $this->height);
			imagesetpixel($this->image, $x, $y, $this->darkColor());
		}
		//画干扰弧
		$m = 5;
		for ($j = 0; $j < $m; $j++) {
			$cx = mt_rand(0, $this->width);
			$cy = mt_rand(0, $this->height);
			$width = mt_rand(0, 100);
			$height = mt_rand(0, 50);
			$s = mt_rand(0, 90);
			$e = mt_rand(90, 180);
			imagearc($this->image, $cx, $cy, $width, $height, $s, $e, $this->darkColor());
		}
	}
	
	protected function drawCode()
	{
		//得到一个格子的宽度
		$width = $this->width / $this->number;
		for ($i = 0; $i < $this->number; $i++) {
			$x = mt_rand($i * $width + 5, ($i + 1) * $width - 10);
			$y = mt_rand(0, $this->height - 15);
			//画验证码
			imagechar($this->image, 5, $x, $y, $this->code[$i], $this->darkColor());
		}
	}
	
	protected function createImage()
	{
		return imagecreatetruecolor($this->width, $this->height);
	}
	
	protected function lightColor()
	{
		return imagecolorallocate($this->image, mt_rand(150, 255), mt_rand(150, 255), mt_rand(150, 255));
	}
	
	protected function darkColor()
	{
		return imagecolorallocate($this->image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120)); 
	}
	
	//写这个魔术方法，让外部可以读取code的值
	function __get($name)
	{
		if ($name == 'code') {
			return $this->$name;
		}
		return false;
	}
	
	function __destruct()
	{
		imagedestroy($this->image);
	}
}








