<?php
namespace Common\Model;

class SpecModel extends \Think\Model\RelationModel{

	protected $_link =[
		'spec_item' =>
			[
				'mapping_type'=>self::HAS_MANY,
				'foreign_key'=>'spec_id',
//				'mapping_fields'=>'id,item'
			],

		'goods_type' =>
			[
				'mapping_type'=>self::BELONGS_TO,
				'foreign_key'=>'type_id'
			],

	];

	//验证
	protected $_validate= [
		['spec_name','require','规格名称不能为空'],
		['spec_name','spec_name','规格名称不能重复',1,'unique'],
		['type_id','require','所属商品模型不能为空'],
	];

	public function spec_add()
	{

		//var_dump(I());

		//规格名称
		//接收数据
		$res = $this->create();

		//判断是否接受成功
		if ($res === false) {
			return $this->getError();
		}

		//规格选项
		$items = I('post.item');
		$itemArr=explode("\n",$items);

		//去除两边空格
		$itemArr=array_map('trim',$itemArr);

		//删除重复的选项
		$itemArr = array_unique($itemArr);

		$tmp=[];
		foreach($itemArr as $k => $v){
			//去除空格
			$trim =trim($v);
			//判断去除空格之后是否为空并且是否重复
			if(!empty($trim)){
				$tmp[]=['item'=>$v];
			}
		}
		// var_dump($tmp);return;
		//判断最后组装出来的$tmp是否为空
		if(empty($tmp)){
			return '规格选项不能为空';
		}


		$res['spec_item'] =$tmp;

		//添加数据
		$row = $this ->relation(true)->add($res);

		//判断是否添加成功
		if (empty($row)) {
			return '添加失败';
		}

		return (int)$row;
	}

	public function spec_edit(){
		//规格名称
//		//接收数据
		$_POST['id'] = I('get.id');

		$res = $this->create();

		//判断是否接受成功
		if ($res === false) {
			return $this->getError();
		}

		//规格选项
		$items = I('post.item');
		$itemArr=explode("\n",$items);

		//去除两边空格
		$itemArr=array_map('trim',$itemArr);

		//删除重复的选项
		$itemArr = array_unique($itemArr);

		//查找数据库中已存在的是数据
		$old=M('spec_item')->where(['spec_id'=>$res['id']])->getField('id,item');

		//要删除的数据
		$del = array_diff($old,$itemArr);

		//要增加的数据
		$add = array_diff($itemArr,$old);
//		dump($add);return;
		// dump($old);
		// dump($del);
		// return;

		$new=[];
		foreach($add as $k => $v){
			if(!empty($v)){
				$new[]=['item'=>$v];
			}
//			//追加一个新元素
//			$new[]=['item'=>$v];
		}

		//判断最后组装出来的数据是否为空
//		if(empty($new[0]['item']) && ($del===$old)){
//			return '规格选项不能为空';
//		}
//		dump($new);return;
		if(empty($new)&& ($del===$old)){
			return '规格选项不能为空';
		}

		//删除要删除的数据
		//先判断是否有要删除的数据

		if(!empty($del)){
			$delrow = M('spec_item')->where([
				'spec_id'=>$res['id'],
				'item'=>['in',$del],
			])->delete();
		}

		//添加数据
		if(!empty($new)) {
			$res['spec_item'] = $new;
		}
//		dump($res);
//		return;

		//修改数据
		$row = $this ->relation('spec_item')->save($res);


//		var_dump($new);
//		var_dump($delrow);
//		var_dump($row);exit;
		//判断是否添加成功
		if (empty($row)&&empty($delrow)&&empty($new)) {
			return false;
		}

		return true;
	}

	public function spec_delete(){
		//有外键因素约束时，用事务
		//开启事务
		$this->startTrans();
		//删除
		$res = M('spec_item')->where(['spec_id'=>I('get.id')])->delete();
		//判断是否删除成功
		if(empty($res)){
			$this->rollback();
			return false;
		}

		$row=$this->delete(I('get.id'));
		//判断是否删除成功
		if(empty($row)){
			$this->rollback();
			return false;
		}

		//提交事务
		$this->commit();
		return true;

		//没有外键因素约束时
//		$res = $this->relation(true)->delete(I('get.id'));
//		if(empty($res)){
//			return false;
//		}
//		return true;
	}

}