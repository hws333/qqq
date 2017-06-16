<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	// M('users')->select();
    	// //获取配置信息
    	// trace(C('DB_NAME'));
    	
    	
    	//判断是否有提交数据
    	if (IS_POST) {
    		//接收数据
    		$user_name = I('user_name');
    		$password = I('password');
    		$code = I('code');

    		//判断提交的数据是否为空
    		if (empty($user_name)) {
    			$this->error('用户名不能为空');
    		}
    		if (empty($password)) {
    			$this->error('密码不能为空');
    		}
    		if (empty($code)) {
    			$this->error('验证码不能为空');
    		}

    		//判断验证码是否正确
    		$verify = new \Think\Verify();
    		if(!$verify->check($code)){
    			$this->error('验证码不正确');
    		}

    		//判断用户是否存在
    		$res = M('users')->where('user_name='.$user_name)->find();
    		if (empty($res)) {
    			$this->error('用户不存在');
    		}
		

    		//判断密码是否正确
    		if (md5($password)!== $res['password']) {
    			$this->error('密码错误');
    		}

    		//保存用户登录信息
    		// session('user',[
    		// 		'id' => $res['id'],
    		// 		'user_name' => $res['user_name']
    		// 	]);
    		
    		unset($res['password']);
    		session('user',$res);
    		//登录成功
    		return $this->success('登录成功',U('Index/index'));
    	}
    	//加载视图
        $this->display();
    }

    public function verify(){
    	// $config =	array(
    	// 'imageH'    =>  43,               // 验证码图片高度
     //    'imageW'    =>  100,               // 验证码图片宽度
     //    'length'    =>  2,               // 验证码位数
     //    );
     //    $verify = new \Think\Verify($config);
    	$verify = new \Think\Verify();

    	$verify->imageH=43;
    	$verify->imageW=100;
    	$verify->length=2;
    	$verify -> entry();
    	
    }


    public function logout()
    {
        session('user',null);
        return $this->success('退出成功',U('Login/index'));
    }
}

