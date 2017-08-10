<?php
namespace index\controller;
use index\model\DetailModel;
class IndexController extends Controller
{
	function index()
	{

		$detail = new DetailModel;
		//查找数据
		if (!empty($_GET['b'])) {
			$caname = $_GET['b'];
			$result = $detail->lastlimit('tid='.$caname);
			$articalNumber = $detail->articalCount('tid='.$caname);
		} else {
			$result = $detail->lastlimit();
			$articalNumber = $detail->articalCount();
		}
		$this->assign('result',$result);
		//标签分类
		$res = $detail->search();
		$this->assign('res',$res);

		//标签分类
		$re = $detail->searc();
		$this->assign('re',$re);

		//计算文章总数		
		$this->assign('articalNumber',$articalNumber);
		
		//分页
		$page = $detail->page();
		$this->assign('page',$page);

		//获取站点信息
		$siteInfo = $this->siteInfo();
		$this->assign('siteInfo',$siteInfo);
		$this->display();
	}	

}