<?php
namespace Home\Controller;
use Think\Controller;
class IntroductionController extends Controller {
    public function index(){
    	//查询数据
    	$intro = M('Introduction')->order('id desc')->limit(1)->find();
    	$this->assign('intro',$intro);

        $this->display();
    }
}