<?php
namespace admin\model;
use vendor\Model;

class AboutModel extends Model
{
	function getInfo()
	{
		return $this->where('id=1')->select();
	}

	function updateInfo($data)
	{
		$this->where('id = 1')->update($data);
	}
}