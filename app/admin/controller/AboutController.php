<?php
namespace admin\controller;

use admin\model\AboutModel;

class AboutController extends Controller
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

	function about()
	{
		$obj = new AboutModel;

		if (!empty($_POST['name'])) {
			$obj->updateInfo($_POST);
		}
		
		$data = $obj->getInfo()[0];
		$this->assign('data',$data);
		$this->display();
	}
}