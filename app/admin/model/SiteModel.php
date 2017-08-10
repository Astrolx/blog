<?php
namespace admin\model;
use vendor\Model;

class SiteModel extends Model
{
	function site()
	{
		return $this->select();
	}

	function updatesite($data)
	{
		$this->where('sid=1')->update($data);
	}

	function selectInfo()
	{
		return $this->select();
	}
}