<?php

namespace index\controller;
use index\model\DetailModel;
class ArticalController extends Controller
{
	function send()
	{
		$detail = new DetailModel;
		$result = $detail->search();
		if (!empty($_POST['title'])) 
		{
			$category = $detail->search($_POST['choice']);
			$_POST['content'] = addslashes($_POST['content']);
			$info = $detail->addartical($_POST['title'],$_POST['content'],$category[0]['category'],$category[0]['cid'],$_SESSION['name']);
			if ($info) {
				$this->notice('发表博文成功','index.php');
				die;
			} else {
				$this->notice('发表博文失败');
				die;
			}
		}
		$this->assign('result',$result);
		$this->display();
	}
}