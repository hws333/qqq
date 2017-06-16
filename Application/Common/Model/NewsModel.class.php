<?php
namespace Common\Model;

class NewsModel extends \Think\Model\RelationModel{
	public $_link=[
		'news_pic' =>
			[
				'mapping_type'=>self::HAS_MANY,
				'foreign_key'=>'news_id',
			]
	];

	public $_validate=[
		['news_title','require','新闻标题不能为空'],
		['news_title','0,30','新闻标题不能超过30个字符',1,'length'],
		['image','require','请上传图片',1],
		['content_one','require','新闻内容1不能为空',1],
		['content_two','require','新闻内容2不能为空',1],
	];

	public function news_add()
	{
		//判断用户是否有主动选择主图，没有则默认第一张图片为主图
		if (empty(I('image')) && !empty(I('pic'))) {
			$_POST['image']=$_POST['pic'][0];
			unset($_POST['pic'][0]);
		}

		//开始事务
		$this->startTrans();

		//收集信息
		$res=$this->create();
		if ($res===false) {
			return $this->getError();
		}

		//相册
		$pic=I('pic');
		$photo=[];
		foreach ($pic as $k => $v) {
			$photo[]=['photo'=>$v];
		}
		$res['news_pic']=$photo;
		$res['create_time']=time();

		//添加
		$id=$this->relation('news_pic')->add($res);

		if (empty($id)) {
			$this->rollback;
			return '添加失败';
		}
		//提交事务
		$this->commit();
		return true;
	}

	public function news_del()
	{
		$this->startTrans();
		$id=I('id');
		$map=['news_id'=>$id];
		//删除相册
		relation_del('news_pic',$map);

		//删除新闻
		$news_row=$this->delete($id);
		if (empty($news_row)) {
			$this->rollback;
			return '删除失败';
		}

		$this->commit();
		return true;
	}

	public function news_edit()
	{
		$id=I('get.id');
		$_POST['id']=$id;

		$this->startTrans();

		$this->create();
		if($res===false){
			return $this->getError();
		}

		$state=false;

		$news_row=$this->save();
		if (!empty($news_row)) {
			$state=true;
		}

		//-----------------修改相册------------------
		//先把旧的相册信息全删除
		$pic=M('news_pic')->where(['news_id'=>$id])->delete();
		if (!empty($pic)) {
			$state=true;
		}
		//添加新数据信息
		if (!empty(I('pic'))) {
			$photo=[];
			foreach (I('pic') as $key => $v) {
				$photo[]=[
					'news_id'=>$id,
					'photo'=>$v
					];
			}
			$pic_id=M('news_pic')->addALL($photo);
			if (!empty($pic_id)) {
				$state=true;
			}
		}

		if ($state===false) {
			$this->rollback;
			return '修改失败';
		}
		$this->commit();
		return true;


	}
}