<?php
namespace Admin\Controller;
class BrandController extends BaseController {
    public function index(){

    	//接收搜索内容
    	$keywords = I('keywords');
    	$map = [];

    	if (!empty($keywords)) {
    		$map['brand_name'] = ['like',"%{$keywords}%"];
    	}

    	// $totalRows  总的记录数
      	$totalRows = M('brand') ->where($map)-> count();
      	// $listRows  每页显示记录数
      	$listRows = 2;

    	$page = new \Think\Page($totalRows,$listRows);
    	$this->assign('page',$page->show());

    	$branddb = M('brand');
    	$res = M('brand')->field('id,brand_name') -> where($map) -> page(I('p',1),$listRows) -> order('id desc')-> select();

    	$this->assign('data',$res);
    	//加载视图
        $this->display();
    }

    public function add(){

    	//判断用户是否提交数据
    	if (IS_POST) {

    		//验证
    		$validate = [
    			['brand_name','require','品牌名称不能为空'],
    			['brand_name','brand_name','该品牌名称已存在',1,'unique'],
    		];

    		//接收数据
    		$branddb = M('brand');
    		$res = $branddb->validate($validate)->create();
    		//错误提示
    		if ($res === false) {
    			return $this ->error ($branddb->getError());
    		}

    		//添加数据
    		$result = $branddb->add($res);

    		//判断是否添加成功
    		if (empty($result)) {
    			return $this -> error('添加失败');
    		}

    		return $this->success('添加成功',U('index'));
    	}

    	//加载视图
        $this->display();
    }

    public function edit(){
		
		if (empty(I('get.id'))) {
    		return $this->error('参数错误');
    	}

		//找出当前要修改数据的信息
		$info = M('Brand')->find(I('get.id'));
		$this->assign('info',$info);

    	if (IS_POST) {
    		//验证
    		$validate=[
    			['brand_name','require','品牌名称不能为空'],
    			['brand_name','brand_name','该品牌名称已存在',1,'unique'],
    		];
    		//当修改数据时，验证字段的唯一，需要把自己的主键组装进去
    		$_POST['id'] = I('get.id');

    		//接收数据
    		$branddb = M('brand');
    		$res = $branddb->validate($validate)->create();

    		//判断数据是否接受成功
    		if ($res === false) {
    			return $this->error($branddb->getError());
    		}

    		//修改
    		$row = $branddb->where(['id'=>I('get.id')])->save();
    		//判断是否修改成功
    		if (empty($row)) {
    			return $this->error('修改失败');
    		}

    		return $this->success('修改成功',U('index'));
    	}


   
    	//加载视图
        $this->display('add');
    }

    public function delete(){
		//判断是否获取到要修改数据的id
		if (empty(I('id'))) {
			return $this->error('参数错误');
		}
		
		$isgoods = M('goods')->where(['brand_id' => I('id')])->find();
		if (!empty($isgoods)) {
			return $this->error('请先把该品牌下的商品删除再执行此操作');
		}

		//执行删除sql语句
	 	$delres =  M('Brand')->delete(I('id'));
	 	
		//判断是否能删除成功
		if (empty($delres)) {
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
    }
}
