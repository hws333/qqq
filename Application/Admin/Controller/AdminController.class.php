<?php
namespace Admin\Controller;

class AdminController extends BaseController
{
	
	public function index()
	{
		//搜索
		$keywords =I('keywords');
		$map=[];
		if (!empty($keywords)) {
			$map['user_name']=['like',"%{$keywords}%"];
		}

		//总的记录数
		$totalRows =M('users')->where($map)->count();
		//每页显示记录数
		$listRows =1;
		$page = new \Think\Page($totalRows,$listRows);
		//传递分页
		$this->assign('page',$page->show());


		//查询数据
		$user = M('users')->field('id,user_name')->where($map)->page(I('p',1),$listRows)->order('id desc')->select();
		//传递数据
		$this->assign('user',$user);


		$this->display();
	}

	/**
	 * @return mixed
     */
	public function add()
	{
		if (IS_POST) {
			//验证
			$validate=[
				['user_name','require','账号名称不能为空'],
				['password','require','密码不能为空'],
				['user_name','3,20','账号长度应在3~20位之间',1,'length'],
				['user_name','user_name','该账号已存在',1,'unique'],
				['password','3,16','密码长度应在3~16位之间',1,'length'],
				['password','enterpassword','密码不一致',1,'confirm'],
			];

			//接收数据
			$res = M('users')->validate($validate)->create();

			//判断是否接收成功
			if ($res === false) {
				return $this->error(M('users')->getError());
			}

			//密码加密
			$res['password']=md5($res['password']);


			//增加数据
			$row = M('users')->add($res);

			//判断是否添加成功
			if (empty($row)) {
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('index'));

		}
		$this->display();
	}

	public function edit()
	{
		//判断是否有接收到id
		if (empty(I('get.id'))) {
			return $this->error('参数错误');
		}

		if (IS_POST) {
			//验证
			$validate = [

				['password','require','密码不能为空'],
				['password','3,16','密码长度应在3~16位之间',1,'length'],
				['password','enterpassword','密码不一致',1,'confirm'],
			];

			//当修改数据时，验证字段的唯一，需要把自己的主键组装进去
			$_POST['id']=I('get.id');

			//接收数据
			$res = M('users')->validate($validate)->create();

			//判断是否接收成功
			if ($res === false) {
				return $this->error(M('users')->getError());
			}

			//密码加密
			$res['password']=md5($res['password']);

			//修改
			$row = M('users')->where(['id'=>I('get.id')])->save($res);

			//判断是否修改成功
			if (empty($row)) {
				return $this->error('修改失败');
			}

			return $this->success('修改成功',U('index'));
		}

		//查询要修改的数据
		$info = M('users')->find(I('get.id'));
		//传递数据
		$this->assign('info',$info);

		$this->display('add');
	}

	public function delete()
	{
		//判断是否有获取到id
		if (empty(I('id'))) {
			return $this->error('参数错误');
		}


		//删除
		$row = M('users')->delete(I('id'));

		//判断是否删除成功
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
}