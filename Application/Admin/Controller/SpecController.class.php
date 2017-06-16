<?php
namespace Admin\Controller;

class SpecController extends BaseController {
	public function index()
	{
		//搜索
		$keywords =I('keywords');
		$map=[];
		if (!empty($keywords)) {
			$map['spec_name']=['like',"%{$keywords}%"];
		}

		//总的记录数
		$totalRows =D('Spec')->where($map)->count();
		//每页显示记录数
		$listRows =1;
		$page = new \Think\Page($totalRows,$listRows);
		//传递分页
		$this->assign('page',$page->show());

		//查询数据
		$spec = D('Spec')->where($map)->relation('goods_type')->page(I('p',1),$listRows)->order('id desc')->select();

		//传递数据
		$this->assign('spec',$spec);

		$this->display();
	}

	public function add()
	{
		if (IS_POST) {

			$result = D('Spec')->spec_add();
			return;

			if (is_string($result)) {
				return $this->error($result);
			}
			return $this->success('添加成功',U('index'));
		}
		//查找出所有的模型分类
		$data = M('goods_type')->select();
		//传递数据
		$this->assign('data',$data);


		$this->display();
	}

	public function edit()
	{
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}

		if(IS_POST){
			$result = D('Spec')->spec_edit();
//			dump($result);
//			return;

			if ($result===false) {
				return $this->error('修改失败');
			}
			return $this->success('修改成功',U('index'));
		}

		//查询数据
		$info=D('Spec')->find(I('get.id'));
		//查询所有商品模型
		$goods_type=M('goods_type')->select();
		// // dump($info);
		// // echo '<hr>';
		// $item=[];
		// foreach($info['spec_item'] as $k => $v){
		// 	$item[]=$v['item'];
		// }
		// $itemStr = implode("\n",$item);

		$item=M('spec_item')->where(['spec_id'=>I('get.id')])->getField('id,item');
		// $itemStr=implode("\r\n",$item);
		$info['item']=implode("\n",$item);
		// dump($itemStr);die;
		//传递数据
		$this->assign('info',$info);
		$this->assign('data',$goods_type);
		// $this->assign('itemStr',$itemStr);
		$this->display('add');
	}

	public function delete()
	{
		if(empty(I('get.id'))){
			return $this->error('参数错误');
		}

		//删除
		$res = D('Spec')->spec_delete();

		//判断是否删除成功
		if($res===false){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));


		$this->display();
	}

}