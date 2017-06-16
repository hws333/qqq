<?php

namespace Admin\Controller;


class CategoryController extends BaseController
{
	
	public function index()
	{

		//判断是否有搜索
		$keywords =I('keywords');
		$map = [];
		if (!empty($keywords)) {
			$map['cate_name']=['like',"%{$keywords}%"];
		}

		//查询数据
		$cate = M('category')->where($map)->order('id desc')->select();

		$tree = cate_tree($cate);

		//传递数据
		$this -> assign('cate',$tree);

		$this->display();
	}

	public function add()
	{
		if (IS_POST) {
			//验证规则
			$validate = [
				['cate_name','require','分类名称不能为空']
			];

			//接收数据
			$res = M('category') -> validate($validate) -> create();

			//判断是否接受成功
			if ($res === false) {
				return $this->error(M('category')->getError());
			}

			//添加数据
			$row = M('category') ->add();

			//判断是否添加成功
			if (empty($row)) {
				return $this->error('添加失败');
			}

			return $this->success('添加成功',U('index'));
		}

		//查找所有分类
		$catedata = M('category')->select();

		//调用无极分类函数
//		$result = ctree($catedata);
//		print_r($result);
		$result = cate_tree($catedata);



		//传递分类数据
		$this->assign('data',$result);


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
			$validate= [
				['cate_name','require','分类名称不能为空'],
			];

			$_POST['id']=I('get.id');
			//接收数据
			$data = M('category')->validate($validate)->create();

			//判断是否接受成功
			if ($data === false) {
				return $this->error(M('category')->getError());
			}

			//修改
			$res = M('category')->where(['id'=>I('get.id')])->save();

			//判断是否修改成功
			if (empty($res)) {
				return $this->error('修改失败');
			}

			return $this->success('修改成功',U('index'));
		}

		//查询数据
		$info = M('category')->find(I('get.id'));
		//查找分类数据
		$cate = M('category')->select();
		$catetree = cate_tree($cate);

		//排除自己的分类及子类
		$level = 0;
		foreach($catetree as $k =>$v){
			//找出自己的分类id
			if($v['id']== I('get.id')){
				$level = $v['level'];
				unset($catetree[$k]);
				continue;
			}
			if($level>0){
				if($v['level']>$level){
					unset($catetree[$k]);
				}else{
					break;
				}
			}
		}

		//传递数据
		$this->assign('info',$info);
		$this->assign('data',$catetree);

		$this->display('add');
	}

	public function delete()
	{
		//判断是否有接收到id
		if (empty(I('id'))) {
			return $this -> error('参数错误');
		}
		//判断该分类下是否还有子级分类
		$child =M('category')->where(['pid'=>I('id')])->find();
		if(!empty($child)){
			return $this->error('请先把该分类下的子级分类全清楚再执行该操作');
		}
		//判断该分类下的商品是否已完全清除
		$isgoods=M('goods')->where(['category_id'=>I('get.id')])->getField('id');
		if (!empty($isgoods)) {
			return $this->error('请先把该分类下的商品全清楚再执行该操作');
		}
		
		//删除
		$res = M('category')->delete(I('id'));

		//判断是否删除成功
		if (empty($res)) {
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
}