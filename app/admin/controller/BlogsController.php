<?php
namespace admin\controller;

use admin\model\DetailModel;

class BlogsController extends Controller
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

	//博文管理
	function blogs()
	{
		$newname = new DetailModel;

		//更新文章信息
		if (!empty($_GET['bid'])) {
			//var_dump($_POST);
			$newname->updateInfo($_GET['bid'],$_POST);
		}

		//删除博文和评论
		if (!empty($_GET['id'])) {
			$newname->deleteblogs($_GET['id']);
		}
		//还原博文
		if (!empty($_POST['returns'])) {
			$newname->returnBlog($_POST['returns']);
		}
		//放入回收站
		if (!empty($_POST['select'])) {
			$newname->trashBlog($_POST['select']);
		}

		//查询博文信息
		$result = $newname->blogs();
		//var_dump($result);
		//查询回收站的博文数量
		$jian = $newname->jian();
		if (empty($result)) {
			$number = 0;
		} else {
			$number = count($result) - $jian;
		}
		$this->assign('number',$number);
		$this->assign('result',$result);
		$this->assign('jian',$jian);
		$this->display();
	}
}