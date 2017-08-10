<?php
namespace admin\controller;

use admin\model\DetailModel;

class CategoryController extends Controller
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

	//板块管理
	function category()
	{
		$newname = new DetailModel;

		//计算版块数量
		$res = $newname->search();
		$number = count($res);

		//加入版块信息
		$newname->addmodule(@$_POST['category'],$number + 1);

		//删除板块
		if (!empty($_GET['id'])) {
			$newname->deletemodule($_GET['id'],$_GET['cid']);
		}

		//获取版块信息
		$result = $newname->search();	
		$this->assign('result',$result);
		$this->display();
	}
}