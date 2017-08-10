<?php
namespace admin\controller;

use admin\model\DetailModel;

class CommentController extends Controller
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

	//评论管理
	function comment()
	{
		$newname = new DetailModel;

		if (!empty($_POST)) {
			$newname->deletecomment($_POST['select']);
		}

		//获取信息
		$result = $newname->readcomment();
		if (empty($result)) {
			$number = 0;
		} else {
			$number = count($result);
		}
		
		$this->assign('number',$number);
		$this->assign('result',$result);
		$this->display();
	}
}