<?php
namespace vendor;

class Upload
{
	//上传过来的键值
	protected $key;
	
	//上传文件保存的路径
	protected $path = './upload';
	//允许上传的mime类型
	protected $allowMime = ['image/png', 'image/gif', 'image/jpeg', 'image/bmp'];
	//允许上传的后缀
	protected $allowSuffix = ['jpg', 'jpeg', 'gif', 'png', 'wbmp'];
	//允许上传的大小限制
	protected $maxSize = 2000000;
	//上传图片的前缀
	protected $prefix = 'up_';
	//上床图片的名字是否随机
	protected $isRandName = true;
	
	//保存的图片的原来的信息
	//图片名字
	protected $oldName;
	//图片后缀
	protected $suffix;
	//图片mime
	protected $mime;
	//图片大小
	protected $size;
	//图片路径
	protected $tmpPath;
	
	//错误号码
	protected $errorNumber;
	protected $errorInfo;
	
	//该数组存放的是需要初始化的所有属性，以键值对形式给你
	function __construct($arr = [])
	{
		foreach ($arr as $key => $value) {
			//该方法为后续的设置错误代码提供支持
			$this->setOption($key, $value);
		}
	}
	
	protected function setOption($key, $value)
	{
		//判断$key是不是我这个类的成员属性，如果不是不用设置
		$arr = get_class_vars(__CLASS__);
		//得到所有的属性名
		$keys = array_keys($arr);
		if (in_array($key, $keys)) {
			$this->$key = $value;
		}
	}
	
	//文件上传函数
	public function uploadFile($key)
	{
		$this->key = $key;
		//判断path有没有设置过，如果没有设置，给出错误信息
		if (empty($this->path)) {
			$this->setOption('errorNumber', -1);
			return false;
		}
		//判断path是不是文件夹，判断权限是否可读写
		if (!$this->checkDir()) {
			$this->setOption('errorNumber', -2);
			return false;
		}
		//得到上传文件的所有信息
		$error = $_FILES[$key]['error'];
		if ($error) {
			//有错
			$this->setOption('errorNumber', $error);
			return false;
		} else {
			//没错  得到旧文件的所有的信息，保存到成员属性中
			$this->getOldInfo();
		}
		
		//判断mime、后缀、size
		if (!$this->checkMime() || !$this->checkSuffix() || !$this->checkSize()) {
			return false;
		}
		
		//生成新的文件名
		$newName = $this->createNewName();
		$filePath = rtrim($this->path, '/') . '/' . $newName;
		
		//判断是否是上传文件，如果是，移动之
		if (is_uploaded_file($this->tmpPath)) {
			//是上传文件
			if (move_uploaded_file($this->tmpPath, $filePath)) {
				//移动成功
				return $filePath;
			} else {
				//移动失败
				$this->setOption('errorNumber', -7);
				return false;
			}
		} else {
			//不是上传文件
			$this->setOption('errorNumber', -6);
			return false;
		}
	}
	
	protected function createNewName()
	{
		if ($this->isRandName){
			//启用随机的名字
			return $this->prefix . uniqid() . '.' . $this->suffix;
		} else {
			//使用原来的名字
			return $this->prefix . $this->oldName;
		}
	}
	
	protected function checkMime()
	{
		if (!in_array($this->mime, $this->allowMime)) {
			$this->setOption('errorNumber', -3);
			return false;
		}
		return true;
	}
	
	protected function checkSuffix()
	{
		if (!in_array($this->suffix, $this->allowSuffix)) {
			$this->setOption('errorNumber', -4);
			return false;
		}
		return true;
	}
	
	protected function checkSize()
	{
		if ($this->size > $this->maxSize) {
			$this->setOption('errorNumber', -5);
			return false;
		}
		return true;
	}
	
	protected function getOldInfo()
	{
		//baidu.jpg
		$this->oldName = $_FILES[$this->key]['name'];
		$this->suffix = pathinfo($this->oldName)['extension'];
		$this->mime = $_FILES[$this->key]['type'];
		$this->size = $_FILES[$this->key]['size'];
		$this->tmpPath = $_FILES[$this->key]['tmp_name'];
	}
	
	//判断文件是否存在，是否是文件夹，以及权限够不够
	protected function checkDir()
	{
		if (!file_exists($this->path) || !is_dir($this->path)) {
			//  /abc/def/g
			return mkdir($this->path, 0777, true);
		}
		if (!is_writeable($this->path) || !is_readable($this->path)) {
			return chmod($this->path, 0777);
		}
		return true;
	}
	
	function __get($name)
	{
		if ($name == 'errorNumber') {
			return $this->errorNumber;
		} else if ($name == 'errorInfo') {
			return $this->getInfo();
		}
	}
	
	protected function getInfo()
	{
		$errorArray = [
			-1 => '路径灭有设置',
			-2 => '文件夹错误',
			-3 => 'mime不符合',
			-4 => '后缀不符合',
			-5 => '大小不符合',
			-6 => '不是上传文件',
			-7 => '移动文件失败',
			1 => '超过php.ini设置',
			2 => '超过html表单设置',
			3 => '部分文件上传',
			4 => '文件没有上传',
			6 => '找不到临时文件',
			7 => '写入失败',
		];
		return $errorArray[$this->errorNumber];
	}
}	
















