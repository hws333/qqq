<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	
    	//查询轮播图
    	$banner=M('Banner')->limit(3)->select();
    	$this->assign('banner',$banner);

        $this->display();
    }
}