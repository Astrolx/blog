<?php

class Start
{
	public static $auto;
	static function init()
	{
		self::$auto = new Psr4Autoload();
	}
	
	static function router()
	{
		$m = empty($_GET['m']) ? 'index' : $_GET['m'];
		//取出控制器
		$c = empty($_GET['c']) ? 'index' : $_GET['c'];
		//取出方法
		$a = empty($_GET['a']) ? 'index' : $_GET['a'];
		$_GET['c'] = $c;
		$_GET['a'] = $a;
		$_GET['m'] = $m;
 
		//拼接带有命名空间的类名
		$c =$m . '\\controller\\' . ucfirst($c) . 'Controller';
		//创建对象;
		call_user_func([new $c(), $a]);
	}
}

Start::init();