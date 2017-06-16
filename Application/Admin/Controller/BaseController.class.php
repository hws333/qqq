<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller
{
	
	public function _initialize()
	{
		$this -> checklogin();
	}

	protected function checklogin()
	{
		if (! session('?user')) {
			$this->error('请登录',U('Login/index'));
		}
	}
}
