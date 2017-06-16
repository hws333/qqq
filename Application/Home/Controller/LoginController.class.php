<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $title = '登录';
        $this->assign('title',$title);

        $this->display();
    }

    public function register(){
        if(IS_POST){
//            dump(I());
            $res= D('Customer')->cus_register();
            dump($res);return;

//            if($res !== true){
//                return $this->error($res);
//            }
//            return $this->success('注册成功');
        }

        //查询国家为中国的省份
        $province = M('region')->where(['region_type'=>1])->select();
        $this->assign('province',$province);

        $title = '注册';
        $this->assign('title',$title);

        $this->display();
    }

    public function vcode(){

        $vcode = new \Think\Verify();
        $vcode->imageW = 58;
        $vcode->imageH = 26;
        $vcode->length=2;
        $vcode->fontSize=16;
        $vcode -> entry();

    }

    //查找城市及地区
    public function getRegion(){
        $pid=I('pid');
        dump($pid);
        $region = M('region')->where(['parent_id'=>$pid])->select();
//        $data=cate_tree($region,$pid);
        dump($region);die;


    }
}