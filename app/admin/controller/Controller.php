<?php
namespace admin\controller;
use vendor\Tpl;
use admin\model\SiteModel;
class Controller extends Tpl
{
	function __construct()
	{
		$config = $GLOBALS['config'];
		$cacheDir = $config['TPL_CACHE'];
		$viewDir = $config['TPL_VIEWS'];
		date_default_timezone_set('PRC');
		parent::__construct($cacheDir, $viewDir);
	}
	
	function display($viewName = null, $isInclude = true, $uri = null)
	{
		if (empty($viewName)) {
			$viewName = $_GET['c'] . '/' . $_GET['a'] . '.html';
		}
		parent::display($viewName, $isInclude, $uri);
	}
	
	function notice($msg, $url = null, $second = 3)
	{
		if (empty($url)) {
			$url = $_SERVER['HTTP_REFERER'];
		}
		$this->assign('msg', $msg);
		$this->assign('url', $url);
		$this->assign('second', $second);
		$this->display('notice.html');
	}

	//获取站点信息
	function siteInfo()
	{
		$newname = new SiteModel();
		return $newname->selectInfo();
	}

}