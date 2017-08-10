<?php
namespace admin\controller;

use admin\model\UserModel;

class UiController extends Controller
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
	//用户管理
	function ui()
	{	
		$newname = new UserModel;

		//锁定用户
		if (!empty($_GET['id'])) {
			$newname->userlock($_GET['id']);
		}
		

		//删除用户
		$newname->userdelete(@$_POST['select']);

		//获取用户信息
		$user = $newname->usercontrol();
		$usernumber = count($user);
		$this->assign('usernumber',$usernumber);
		$this->assign('user',$user);
		$this->display();
	}
}