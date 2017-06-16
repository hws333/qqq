<?php
namespace Admin\Controller;
class BannerController extends BaseController {
    public function index(){

        //接收搜索内容
        $keywords = I('keywords');
        $map = [];

        // if (!empty($keywords)) {

        //     $map['content'] = ['like',"%{$keywords}%"];
        // }

        // $totalRows  总的记录数
        $totalRows = M('banner') ->where($map)-> count();
        // $listRows  每页显示记录数
        $listRows = 3;

        $page = new \Think\Page($totalRows,$listRows);
        $this->assign('page',$page->show());


        //查询数据
        $banner = M('Banner')->where($map)->order('id desc')->page(I('p',1),$listRows)->select();

        //传递数据
       $this->assign('banner',$banner);
    	$this->display();
    }

    public function add(){
    	if(IS_POST){
            // dump(I());die;
          $res= D('Banner')->banner_add();
          // dump($res);return;

            //判断是否增加成功
            if(is_string($res)){
                return $res;
            }
            return $this->success('添加成功',U('index'));
        }
        //查询所有商品
        $goods = M('goods')->select();
        $this->assign('goods',$goods);

    	$this->display();

    }

    public function edit(){
    	if (empty(I('get.id'))) {
            return $this->error('参数错误');
        }

        if (IS_POST) {
                // dump(I());die;
            $row =  D('Banner')->banner_edit();
            
            //判断是否能删除成功
            if ($row===false) {
                return $this->error('修改失败');
            }
            return $this->success('修改成功',U('index'));
        }

        //查询要修改的数据
        $banner = M('Banner')->find(I('id'));
        $this->assign('banner',$banner);

        //查询所有商品
        $goods = M('goods')->select();
        $this->assign('goods',$goods);

    	$this->display('add');
    }

    public function delete(){

    	//判断是否获取到要修改数据的id
        if (empty(I('id'))) {
            return $this->error('参数错误');
        }
        
        //执行删除sql语句
        $delres =  D('Banner')->banner_del();
        
        //判断是否能删除成功
        if ($delres===false) {
            return $this->error('删除失败');
        }
        return $this->success('删除成功',U('index'));
    }
}