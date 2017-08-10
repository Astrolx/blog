<?php

namespace admin\model;
use vendor\Model;
class UserModel extends Model
{
	function add($data)
	{
		$id = $this->insert($data);
		return $id;
	}

	function checklogin($result,$pwd,$name)
	{
		$info = '';
		if ($result) {
			if ($result[0]['password'] == $pwd) {
				$_SESSION['name'] = $name;
				$_SESSION['type'] = $result[0]['type'];
				//header('location:index.php');
				$info = '登陆成功';
				return [true,$info];
			} else {
				$info = '两次密码不一致';
				return [false,$info];
			}
		} else {
			$info = '用户不存在';
			return [true,$info];
		}
	}

	function selectUser()
	{
		$name = $_SESSION['name'];
		return $this->where("name='$name'")->select();
	}

	function istop($id)
	{
		$this->update(['istop' => 0]);
		$this->where('id=' . $id)->update(['istop' => 1]);
	}

	//获取用户信息
	function usercontrol()
	{
		return $this->select();
	}

	//锁定用户
	function userlock($data)
	{
		if ($data) {
			$res = $this->where('id=' . $data)->field('islock')->select();
			if ($res[0]['islock'] == 0) {
				return $this->where('id=' . $data)->update(['islock' => 1]);
			} else {
				return $this->where('id=' . $data)->update(['islock' => 0]);
			}
		}
	}

	//删除用户
	function userdelete($data)
	{
		if ($data) {
			foreach ($data as $key => $value) {
				$this->where('id=' . $value)->delete();
			}
		}
	}
}