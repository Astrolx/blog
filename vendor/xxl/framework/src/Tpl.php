<?php
namespace vendor;
class Tpl
{
	//缓存路径
	protected $cacheDir;
	//模板路径
	protected $viewDir;
	//过期时间
	protected $lifeTime;
	//变量数组
	protected $vars = [];
	
	function __construct($cacheDir = './cache/', $viewDir = './view/', $lifeTime = 7200)
	{
		//判断文件夹是否存在，是否可读写
		if (!$this->checkDir($cacheDir) || !$this->checkDir($viewDir)) {
			die('文件夹有问题，不符合要求');
		}
		//初始化成员属性
		$this->cacheDir = $cacheDir;
		$this->viewDir = $viewDir;
		$this->lifeTime = $lifeTime;
	}
	
	protected function checkDir($path)
	{
		if (!file_exists($path) || !is_dir($path)) {
			return mkdir($path, 0777, true);
		}
		
		if (!is_writeable($path) || !is_readable($path)) {
			return chmod($path, 0777);
		}
		return true;
	}
	//  $name = '赵雅芝';  'name' => '赵雅芝'
	//  $tpl->assign('name', $name);   compact()
	//  $tpl->assign('array', $array);
	function assign($name, $value) 
	{
		$this->vars[$name] = $value;
	}
	
	function display($viewName, $isInclude = true, $uri = null)
	{
		//判断你有没有给我传递viewname
		if (empty($viewName)) {
			die('二货，没有模板如何显示');
		}
		
		//拼接模板文件的全路径，然后判断这个模板文件是否存在
		$viewPath = rtrim($this->viewDir, '/') . '/' . $viewName;
		if (!file_exists($viewPath)) {
			die('该模板文件不存在');
		}
		
		//根据模板文件生成缓存文件   /a/b/index.html
		$cacheName = md5($viewName . $uri) . '.php';
		$cachePath = rtrim($this->cacheDir, '/') . '/' . $cacheName;
		
		//判断缓存文件是否存在乎
		if (!file_exists($cachePath)) {
			//去模板文件中，将所有的模板语法替换为php的语法
			$php = $this->compile($viewPath);
			//生成缓存文件
			file_put_contents($cachePath, $php);
		} else {
			//判断缓存文件是否过期
			$isTimeout = (filemtime($cachePath) + $this->lifeTime) > time() ? false : true;
			//判断模板文件有没有修改过
			$isChange = filemtime($viewPath) > filemtime($cachePath) ? true : false;
			if ($isTimeout || $isChange) {
				//缓存都要重新生成
				$php = $this->compile($viewPath);
				//生成缓存文件
				file_put_contents($cachePath, $php);
			}
		}
		
		if ($isInclude) {
			//将变量解析出来
			extract($this->vars);
			include $cachePath;  //将缓存文件包含进来
		}
	}
	
	protected function compile($viewPath)
	{
		//将模板文件全部读进来，保存到字符串html中
		$html = file_get_contents($viewPath);
		//正则替换之   '#\{\$(.+?)\}#'
		$array = [
			'{$%%}'		=>	'<?=$\1; ?>',
			'{if %%}'	=>	'<?php if (\1): ?>',
			'{else}'	=> 	'<?php else: ?>',
			'{/if}'		=>	'<?php endif; ?>',
			'{foreach %%}' => 	'<?php foreach (\1): ?>',
			'{{%%}}'   => '<?php (\1) ?>',
			'{/foreach}'   =>	'<?php endforeach; ?>',
			'{include %%}' =>   '所以这里是骗人的',  // head.html
		];
		foreach ($array as $key => $value) {
			$pattern = '#' . str_replace('%%', '(.+?)', preg_quote($key)) . '#';
			//正则替换
			if (strstr($pattern, 'include')) {
				$html = preg_replace_callback($pattern, [$this, 'parseInclude'], $html);
				//call_user_func([$obj, 'test']);
			} else {
				$html = preg_replace($pattern, $value, $html);
			}	
		}
		return $html;
	}
	
	protected function parseInclude($data)
	{
		//head.html
		$fileName = trim($data[1], '\'"');
		//生成head.html文件的缓存
		$this->display($fileName, false);
		//得到缓存文件的全路径
		$filePath = rtrim($this->cacheDir, '/') . '/' . md5($fileName) . '.php';
		return '<?php include "' . $filePath . '"?>';
	}
}













