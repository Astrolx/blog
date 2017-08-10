<?php

namespace index\controller;

use index\model\DetailModel; 
use index\model\UserModel;
class DetailController extends Controller
{
	function detail()
	{
		//浏览数量增加计算
		$detail = new DetailModel;
		if (empty($_GET['istop']) and empty($_GET['canceltop'])) {
			$detail->addhit($_GET['id']);
		}

		//增加评论
		if (!empty($_GET['replay'])) {
			if (empty($_SESSION['name'])) {
				$this->notice('登录后可发表评论');
				die;
			}
			$detail->addreplay($_GET['id'],$_SESSION['name'],$_POST['content']);
		}	

		//评论数量统计
		$numberInfo = $detail->commentnumber($_GET['id']);
		$this->assign('numberInfo',$numberInfo);
		
		//查询文章信息		
		$artical = $detail->artical($_GET['id']);
		$artical[0]['content'] = htmlentities($artical[0]['content']);
		//查询作者信息
		$use = new UserModel;
		if (!empty($_SESSION['name'])) {			
			$user = $use->selectUser();
			$this->assign('user',$user);
		}

		//查询回复信息
		$replay = $detail->replay($_GET['id']);
		$this->assign('replay',$replay);

		//置顶
		if (!empty($_GET['istop'])) {
			$detail->istop($_GET['id']);
		}

		//取消置顶
		if (!empty($_GET['canceltop'])) {
			$detail->canceltop();
		}
		
		//获取站点信息
		$siteInfo = $this->siteInfo();
		$this->assign('siteInfo',$siteInfo);
			
		$this->assign('artical',$artical);
		$this->display();
	}
	
}