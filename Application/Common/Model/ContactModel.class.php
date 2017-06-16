<?php
namespace Common\Model;

class ContactModel extends \Think\Model{
	protected $_validate=[
		['user_name','require','用户名不能为空'],
		['user_name','user_name','该用户名已存在',1,'unique'],
		['user_name','0,30','用户名长度不能超过30个字符',1,'length'],
		['email','require','邮箱不能为空'],
		['email','email','邮箱格式不正确'],
		['email','0,30','邮箱长度不能超过30个字符',1,'length'],
		['tel','require','电话不能为空'],
		['tel','number','电话格式不正确'],
		['content','require','内容不能为空']
	];

	public function msg()
	{
		// die(I('email'));
		$res=$this->create();
		die($res);

		if ($res===false) {
			return $this->getError();
		}

		$id = $this->add();

		if (empty($id)) {
			return '留言失败,请重试';
		}

		return true;
	}

	public function cta_del()
	{
		//开启事务
		$this->startTrans();
		$row=$this->delete(I('id'));
		if (empty($row)) {
			$this->rollback();
			return false;
		}
		$this->commit();
		return true;
	}
}