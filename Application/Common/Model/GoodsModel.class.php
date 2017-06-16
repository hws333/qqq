<?php
namespace Common\Model;

class GoodsModel extends \Think\Model\RelationModel
{
	
	public $_link=[
		'brand'=>[
			'mapping_type'=>self::BELONGS_TO,
			'class_name'=>'Brand',
			// 'foreign_key'=>'brand_id'
		],
		'category'=>[
			'mapping_type'=>self::BELONGS_TO,
			'class_name'=>'Category',
			'foreign_key'=>'category_id'
		],
		'goods_desc'=>[
			'mapping_type'=>self::HAS_ONE,
			'class_name'=>'Goods_desc',
			'foreign_key'=>'goods_id'
		],
		'goods_pic'=>[
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Goods_pic',
			'foreign_key'=>'goods_id'
		],
		'goods_spec'=>[
			'mapping_type'=>self::HAS_MANY,
			'class_name'=>'Goods_spec',
			'foreign_key'=>'goods_id'
		],
		'comment'=>[
			'mapping_type'=>self::HAS_ONE,
			'class_name'=>'comment',
			'foreign_key'=>'goods_id'
		]
	];

	public $_validate=[
		['goods_name','require','商品名称不能为空'],
		['goods_name','goods_name','商品名称不能重复',1,'unique'],
		['goods_name','0,60','商品名称长度不能超过60个字符',1,'length'],
		['brand_id','require','商品品牌不能为空'],
		['category_id','require','商品分类不能为空'],
		['market_price','require','市场价格不能为空'],
		['market_price','currency','市场价格必须为数字且最多只能有两位小数',1],
		['shop_price','require','商店价格不能为空'],
		['shop_price','currency','商店价格必须为数字且最多只能有两位小数',1],
		['stock','require','库存不能为空'],
		['stock','number','库存必须为整数',1],
		['image','require','请上传图片',1],
		['content','require','商品详情不能为空',1],
		
	];

	public function goods_index()
	{
//		//分页
//        $count=$this->where($map)->count();
//        $showpage=2;
//
//        $page = new \Think\Page($count,$showpage);
//
//          //查询商品信息
//          $info=$this->where($map)->relation(['brand','category'])->page(I('p',1),$showpage)->order('id desc')->select();
//          return $data=[
//          	'page'=> $page->show(),
//          	'info'=>$info
//          ];
		
	}
//	protected function _before_insert(&$data,$options){
//		//判断用户是否有主动选择主图，没有则默认第一张图片为主图
//		if (empty(I('image')) && !empty(I('pic'))) {
//			$_POST['image']=$_POST['pic'][0];
//			unset($_POST['pic'][0]);
//		}
//
//		dump($data);
//
////	die(I('image'));
//	}

	public function goods_add()
	{
		//------------商品信息------------------
		//判断用户是否有主动选择主图，没有则默认第一张图片为主图
		if (empty(I('image')) && !empty(I('pic'))) {
			$_POST['image']=$_POST['pic'][0];
			unset($_POST['pic'][0]);
		}

		//开始事务
		$this->startTrans();

		//收集商品表信息
		$res=$this->create();

//		dump($res);
//		return;
		//判断是否接收成功
		if ($res===false) {
//			die($this->getError());
			 return $this->getError();
		}

		// $goods_id=$this->add();

		//商品详情
		 $res['goods_desc']['content']=I('post.content');

		//相册
		 if (!empty(I('pic'))) {
		 	$pic=I('pic');
			$photo=[];
			foreach ($pic as $key => $value) {
				$photo[]=[
					'photo'=>$value
				];
			}
			$res['goods_pic']=$photo;
		 }

		 //套餐
		 if (!empty(I('spec_price'))) {
			$spec_price=I('spec_price');
			$spec_id=I('spec_id');
			$spec_stock=I('spec_stock');
			$spec=[];
			foreach ($spec_price as $key => $v) {
				if (!empty(trim($v))) {
					$spec[]=[
					'spec_price'=>is_numeric($v) ? $v : 0,
					'spec_key'=>$key,
					'spec_id'=>$spec_id,
					'spec_stock'=>$spec_stock[$key],
					];
				}
			}
			$res['goods_spec']=$spec;
		}

		//添加商品表信息
		 $goods_id=$this->relation(true)->add($res);
//		exit;

		//判断是否添加成功
		if (empty($goods_id)) {
			$this->rollback();
//			die('商品表添加失败');
			  return '添加失败';
		}

//return true;
//		//------------商品详情------------------
//
//		$desc=M('goods_desc')->create();
//
//		if ($desc===false) {
//			$this->rollback;
////			die($this->getError());
//			 return $this->getError();
//		}
//		//组装商品主键
//		$desc['goods_id']=$goods_id;
//
//		$desc_row=M('goods_desc')->add($desc);
//		//判断是否添加成功
//		if (empty($desc_row)) {
//			$this->rollback;
////			die('商品详情添加失败');
//			 return '添加失败';
//		}
//
//
//		//------------商品相册------------------
//		if (!empty(I('pic'))) {
//			$pic=I('pic');
//			$photo=[];
//			foreach ($pic as $key => $value) {
//				$photo[]=[
//					'goods_id'=>$goods_id,
//					'photo'=>$value
//				];
//			}
//			// return $photo;
//			$photoId=M('goods_pic')-> addAll($photo);
//			// return $photoId;
//
//			if (empty($photoId)) {
//				$this->rollback;
////				die('商品相册添加失败');
//				 return '添加失败';
//			}
//		}
//
//
//		//------------商品套餐------------------
//		if (!empty(I('spec_price'))) {
//			$spec_price=I('spec_price');
//			$spec_id=I('spec_id');
//			$spec=[];
//			foreach ($spec_price as $key => $v) {
//				if (!empty(trim($v))) {
//					$spec[]=[
//					'goods_id'=>$goods_id,
//					'spec_price'=>is_numeric($v) ? $v : 0,
//					'spec_key'=>$key,
//					'spec_id'=>$spec_id
//				];
//				}
//
//			}
//			if (!empty($spec)) {
//				$specRow=M('goods_spec')->addAll($spec);
//				if (empty($specRow)) {
//					$this->rollback;
////					die('商品套餐添加失败');
//					 return '添加失败';
//				}
//			}
//
//		}

		//提交事务
		$this->commit();
		return true;
	}

	public function goods_edit(){
		$id=I('get.id');
		$_POST['id']=$id;
//		return $_POST['id'];
		$res=$this->create();
//		return $res;
		if($res===false){
			return $this->getError();
		}
//return;
		$state=false;
		$this->startTrans();

		//修改当前商品信息
		$goods_row=$this->save();
		if(!empty($goods_row)){
			$state=true;
		}

		$map=['goods_id'=>$id];
		//--------------------修改详情-----------------
		$desc=M('goods_desc')->create();
		if($desc===false){
			return $this->getError();
		}
		//修改当前商品信息
		$desc_row=M('goods_desc')->where($map)->save();
		if(!empty($desc_row)){
			$state=true;
		}

		//--------------------修改相册-----------------
		//先判断是否相等
		$getpic=I('pic');
		$sqlpic=M('goods_pic')->where($map)->select();
		$piclist = [];
		foreach ($sqlpic as $k => $v) {
			$piclist[]=$v['photo'];
		}

		if ($getpic !==$piclist) {
			//先删除所有相册信息
			$pic=M('goods_pic')->where($map)->delete();
			if(!empty($pic)){
				$state=true;
			}
	//		return $state;
			//添加相册
			if(!empty(I('pic'))){
				$photo=[];
				foreach(I('pic') as $k => $v){
					$photo[]=[
						'goods_id'=>$id,
						'photo'=>$v
					];
				}
				$pic_id=M('goods_pic')->addAll($photo);
				if(!empty($pic_id)){
					$state=true;
				}
			}
		}
		
		// dump($getpic);
		// dump($piclist);
//		dump($state);
//		die;
		

		//--------------------修改规格-----------------
		//先删除所有规格信息
		$spec=M('goods_spec')->where($map)->delete();
		if(!empty($spec)){
			$state=true;
		}
		//添加规格
		if(!empty(I('spec_price'))){
			$spec_stock=I('spec_stock');
			$item=[];
			foreach(I('spec_price') as $k => $v){
				$item[]=[
					'goods_id'=>$id,
					'spec_price'=>$v,
					'spec_key'=>$k,
					'spec_id'=>I('spec_id'),
					'spec_stock'=>$spec_stock[$k]
				];
			}
			$item_id=M('goods_spec')->addAll($item);
			if(!empty($item_id)){
				$state=true;
			}
		}


		if($state===false){
			$this->rollback();
			return '修改失败';
		}
		$this->commit();
		return true;

	}

	public function goods_del(){
		$id=I('id');
		$map=['goods_id'=>$id];

		//找出该商品信息
		$res = $this->find($id);
		if(empty($res)){
			return '该商品不存在';
		}

		//开启事务
		$this->startTrans();

		//删除详情
		relation_del('goods_desc',$map);

		//删除相册
		relation_del('goods_pic',$map);

		//删除规格
		relation_del('goods_spec',$map);

		//删除评论
		relation_del('comment',$map);

		//删除商品
		$goods_row=$this->delete($id);
		if(empty($goods_row)){
			$this->rollback();
			return '删除失败';
		}
		$this->commit();
		return true;

	}
}