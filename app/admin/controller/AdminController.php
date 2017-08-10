<?php
namespace admin\controller;
use admin\model\SiteModel;

class AdminController extends Controller
{

	function __construct()
	{
		$this->checklogin();
		parent::__construct();
	}

	function checklogin()
	{
		if (empty($_SESSION['name'])) {
			exit('小子，不要黑我的后台');
		}
		if (empty($_SESSION['type'])) {
			exit('普通用户没有权限进入后台');
		}
	}

	//站点信息
	function index()
	{
		$site = new SiteModel;
		//修改站点信息
		if (!empty($_POST)) {
			$site->updatesite($_POST);
		}

		//获取站点信息
		$siteInfo = $site->site();
		$this->assign('siteInfo',$siteInfo);
		$this->display();
	}

	
}