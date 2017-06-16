<?php
namespace Admin\Controller;
class IndexController extends BaseController {
    public function index(){
    	
    	//加载视图
        $this->display();
    }

    public function welcome(){
    	echo 'Admin-Index-welcome';
    	//加载视图
        $this->display();
    }

}