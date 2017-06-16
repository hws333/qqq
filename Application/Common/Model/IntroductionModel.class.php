<?php
namespace Common\Model;
/**
* 
*/
class IntroductionModel extends \Think\Model
{
	protected $_validate=[
		['image','require','请上传图片'],
		['content','require','内容不能为空']
	];
	
	public function intro_add()
	{
		$res = $this->create();
		if ($res===false) {
			return $this->getError();
		}

		$id=$this->add();
		if (empty($id)) {
			return '添加失败';
		}
		return (int)$id;

	}

	public function intro_del()
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

	public function intro_edit()
	{
		$id=I('get.id');
		$_POST['id']=$id;

		$res = $this->create();
		if ($res===false) {
			return $this->getError();
		}

		//开启事务
		$this->startTrans();
		
		$row=$this->save();
		if (empty($row)) {
			$this->rollback();
			return false;
		}
		$this->commit();
		return true;
		
	}
}
