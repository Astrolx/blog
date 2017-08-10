<?php
namespace admin\controller;

use admin\model\DetailModel;

class EditController extends Controller
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

	function edit()
	{
		$obj = new DetailModel;
		//查询文章信息
		$articalInfo = $obj->articalInfo($_GET['id'])[0];
		//查询板块
		$category = $obj->category();

		$this->assign('category',$category);
		$this->assign('articalInfo',$articalInfo);
		$this->display();
	}
}