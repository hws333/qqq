<?php
namespace Admin\Controller;

class ContactController extends BaseController
{
	
	public function index()
	{
		//接收搜索内容
		$keywords = I('keywords');
		$map = [];

		if (!empty($keywords)) {
			$map['user_name'] = ['like',"%{$keywords}%"];
			$map['content'] = ['like',"%{$keywords}%"];
			$map['_logic']='or';
		}
		$count =M('contact')->where($map)->fetchSql(false)->count();
//		dump($count);
		$showpage =4;
		$page = new \Think\Page($count,$showpage);
		$this->assign('page',$page->show());

		//查询留言
		$msg = M('contact')->where($map)->order('id desc')->page(I('p',1),$showpage)->select();
		$this->assign('msg',$msg);
//		dump($msg);

		$this->display();
	}

	public function edit()
	{
		//判断是否获取到要修改数据的id
		if (empty(I('get.id'))) {
			return $this->error('参数错误');
		}
		$contact = D('Contact')->find(I('get.id'));
		$this->assign('contact',$contact);

		$this->display();
	}

	public function delete(){
		//判断是否获取到要删除数据的id
		if (empty(I('get.id'))) {
			return $this->error('参数错误');
		}

		$delres =  D('Contact')->cta_del();

		//判断是否能删除成功
		if ($delres===false) {
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));

	}
}