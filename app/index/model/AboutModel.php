<?php

namespace index\model;
use vendor\Model;

class AboutModel extends Model
{
	function selectAbout()
	{
		return $this->where('id=1')->select();
	}

	function selectKeywords()
	{
		return $this->field('keywords,grade')->where('id>1')->select();
	}

	function switch($data)
	{
		switch ($data) {
			case 1:
				return '★☆☆☆☆';
				break;
			case 2:
				return '★★☆☆☆';
				break;
			case 3:
				return '★★★☆☆';
				break;
			case 4:
				return '★★★★☆';
				break;
			case 5:
				return '★★★★★';
				break;
			case 0:
				return '☆☆☆☆☆';
				break;
			
			default:
				return '没有此等级';
				break;
		}
	}
}
