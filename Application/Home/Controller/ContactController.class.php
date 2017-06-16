<?php
namespace Home\Controller;

class ContactController extends \Think\Controller
{
	public function index()
	{
		//查找信息
		$set = M('Setting')->order('id')->limit(1)->find();
		$this->assign('set',$set);

		$title="联系我们";
		$this->assign('title',$title);

		$this->display();
	}

	public function message()
	{
		$validate=[
			['user_name','require','用户名不能为空'],
			['user_name','user_name','该用户名已存在',1,'unique'],
			['user_name','0,30','用户名长度不能超过30个字符',1,'length'],
			['email','require','邮箱不能为空'],
			['email','email','邮箱格式不正确'],
			['email','0,50','邮箱长度不能超过50个字符',1,'length'],
			['tel','require','电话不能为空'],
			['tel','number','电话格式不正确'],
			['content','require','内容不能为空']
		];
		 if (IS_AJAX) {


		 	$res = M('Contact')->validate($validate)->create();
		 	if ($res === false) {
//		 		die(M('Contact')->getError());
				die(json_encode(['code'=>0,'meg'=>M('Contact')->getError()]));
		 	}
//			 die(json_encode($res));

			 if(empty(I('code'))){
//				 die('验证码不能为空');
				 die(json_encode(['code'=>0,'meg'=>'验证码不能为空']));
			 }
			 //判断验证码是否正确
			 $verify = new \Think\Verify();
			 if(!$verify->check(I('code'))){
//				 die('验证码不正确');
				 die(json_encode(['code'=>0,'meg'=>'验证码不正确']));
			 }

			 unset($res['code']);
			 $id = M('Contact')->add($res);

			 if (empty($id)) {
//				 die('留言失败,请重试');
				 die(json_encode(['code'=>0,'meg'=>'留言失败,请重试']));
			 }
			 die(json_encode(['code'=>1,'meg'=>'添加成功']));
//			 die('添加成功');
		 }else{
			 die(json_encode(['code'=>0,'meg'=>'网络异常']));
//			 die('网络异常');
		 }
	}

	public function verify(){
		$verify = new \Think\Verify();

		$verify->imageH=30;
		$verify->imageW=70;
		$verify->length=3;
		$verify->fontSize=14;
		$verify -> entry();

	}
	
}