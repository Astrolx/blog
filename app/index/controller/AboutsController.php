<?php

namespace index\controller;
use index\model\AboutModel;
use index\model\DetailModel;

class AboutsController extends Controller
{
	function abouts()
	{
		$abou = new AboutModel;
		$keywords = new DetailModel;
		//获取个人信息
		$about = $abou->selectAbout();
		//获取技能信息
		$detail = $abou->selectKeywords();
		$i = 0;
		foreach ($detail as $value) {
			$detail[$i++]['grade'] = $abou ->switch($value['grade']);
		}
		//获取关键字信息
		$keyword = $keywords->selectCategory();
		$this->assign('keyword',$keyword);
		$this->assign('detail',$detail);
		$this->assign('about',$about);
		
		//获取站点信息
		$siteInfo = $this->siteInfo();
		$this->assign('siteInfo',$siteInfo);
		$this->display();
	}
}