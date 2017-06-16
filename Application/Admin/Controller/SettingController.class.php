<?php
namespace Admin\Controller;

class SettingController extends BaseController {
     public function index(){
     	if (IS_POST) {
     		$res = D('Setting')->setedit();
	     	if ($res!==true) {
	     		return $this->error($res);
	     	}
	     	return $this->success('修改成功',U('index'));

     	}
     	
     	//查找信息
     	$set = M('Setting')->order('id')->limit(1)->find();

     	$this->assign('set',$set);
     	$this->display();

     }

    
}