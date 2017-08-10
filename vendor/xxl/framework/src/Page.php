<?php
namespace vendor;

class Page
{
	//当前页
	protected $page;
	//总页数
	protected $totalPage;
	//url
	protected $url;
	//每页显示多少个
	protected $number;
	//总条数
	protected $totalCount;
	
	//初始化
	function __construct($number = 5, $totalCount = 100)
	{
		$this->number = $number;
		$this->totalCount = $totalCount;
		
		//计算总页数
		$this->totalPage = $this->getTotalPage();
		//得到当前页吧
		$this->page = $this->getPage();
		//核心方法  拼接url
		$this->url = $this->getUrl();
		
		//echo $this->url;
	}
	
	protected function getTotalPage()
	{
		return ceil($this->totalCount / $this->number);
	}
	
	protected function getPage()
	{
		if (empty($_GET['page'])) {
			$page = 1;
		} else if ($_GET['page'] < 1) {
			$page = 1;
		} else if ($_GET['page'] > $this->totalPage) {
			$page = $this->totalPage;
		} else {
			$page = $_GET['page'];
		}
		return $page;
	}
	
	protected function getUrl()
	{
		//得到协议
		$scheme = $_SERVER['REQUEST_SCHEME'];
		//得到主机
		$host = $_SERVER['SERVER_NAME'];
		//得到端口号
		$port = $_SERVER['SERVER_PORT'];
		//得到文件路径以及参数  /1703/day04/index.php?username=goudan&page=3
		$uri = $_SERVER['REQUEST_URI'];
		//判断uri中有没有page。有就干之(之就是page)，没有就不动
		$uriArray = parse_url($uri);
		//var_dump($uriArray);
		//先将path提取出来
		$path = $uriArray['path'];
		//判断有没有query这个键
		if (!empty($uriArray['query'])) {
			//将请求字符串变成关联数组
			parse_str($uriArray['query'], $queryArray);
			//var_dump($queryArray);
			//不管这个数组中有没有page这个参数，将其干之
			unset($queryArray['page']);
			//将关联数组在拼接为请求字符串
			$query = http_build_query($queryArray);
			//判断该请求字符串是否为空，如果不为空，拼接到path的后面，为空不用拼接
			if ($query != '') {
				$path = $path . '?' . $query;
			}
		}
		
		//拼接url
		$url = $scheme . '://' . $host . ':' . $port . $path;
		return $url;
	}
	
	protected function setUrl($str)
	{
		if (strstr($this->url, '?')) {
			$url = $this->url . '&' . $str;
		} else {
			$url = $this->url . '?' . $str;
		}
		return $url;
	}
	
	function first()
	{
		return $this->setUrl('page=1');
	}
	
	function end()
	{
		return $this->setUrl('page=' . $this->totalPage);
	}
	
	//上一页   下一页   allUrl  自己先写一下
	function prev()
	{
		if ($this->page - 1 < 1) {
			$page = 1;
		} else {
			$page = $this->page - 1;
		}
		return $this->setUrl('page=' . $page);
	}
	
	function next()
	{
		if ($this->page + 1 > $this->totalPage) {
			$page = $this->totalPage;
		} else {
			$page = $this->page + 1;
		}
		return $this->setUrl('page=' . $page);
	}
	
	function allPage()
	{
		return [
			'first' => $this->first(),
			'prev' => $this->prev(),
			'next' => $this->next(),
			'end' => $this->end(),
		];
	}
	
	//在分页中，你要实现这个方法   limit方法  
	//  limit 偏移量  数量
	//         0,5   5,5  10,5  15,5
	function limit()
	{
		$offset = ($this->page - 1) * $this->number;
		return $offset . ',' . $this->number;
	}
}












