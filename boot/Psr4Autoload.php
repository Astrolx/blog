<?php

class Psr4Autoload
{
	//搞一个成员属性数组，用来存放映射关系
	protected $maps = [];
	
	function __construct()
	{
		spl_autoload_register([$this, 'myAutoload']);
	}
	
	function addMaps($namespace, $path)
	{
		if (array_key_exists($namespace, $this->maps)) {
			die('哥们，这个命名空间已经被映射过了');
		}
		$this->maps[$namespace] = $path;
	}
	
	//自己的自动加载方法
	protected function myAutoload($className)
	{
		//var_dump($className);
		//按照最后一个斜线将带有命名空间的类名拆分为命名空间名和真正的类名
		$pos = strrpos($className, '\\');
		//提取命名空间名
		$namespace = substr($className, 0, $pos);
		$namespace = str_replace('\\', '/', $namespace);
		//提取类名
		$class = substr($className, $pos + 1);
		
		//封装一个方法去找对应的映射关系
		$path = $this->mapLoad($namespace);
		
		//拼接完整的路径
		$filePath = $path . $class . '.php';
		//var_dump($filePath);
		if (file_exists($filePath)) {
			include $filePath;
		} else {
			die('亲,该文件不存在');
		}
	}
	
	protected function mapLoad($namespace)
	{
		//看映射关系中有没有这个命名空间的映射关系
		if (array_key_exists($namespace, $this->maps)) {
			$path = rtrim($this->maps[$namespace], '/') . '/';
		} else {
			$path = rtrim($namespace, '/') . '/';
		}
		return $path;
	}
}















