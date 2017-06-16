<?php
namespace Admin\Controller;

class GoodsTypeController extends BaseController{
    public function index()
    {
        //搜索
        $keywords=I('keywords');
        $map=[];
        if(!empty($keywords)){
            $map['type_name']=['like',"%{$keywords}%"];
        }

        //分页
        $total = M('goods_type')->where($map)->count();
        $listpage = 1;

        $page = new \Think\Page($total,$listpage);

        //传递分页
        $this->assign('page',$page->show());

        //查询数据
        $data = M('goods_type')->where($map)->page(I('p',1),$listpage)->order('id desc')->select();
        //传递数据
        $this->assign('data',$data);
        $this->display();
    }

    public function add()
    {
        if(IS_POST){
            //验证
            $validate=[
                ['type_name','require','规格名称不能为空'],
                ['type_name','type_name','该规格名称已存在',1,'unique']
            ];

            //接收数据
            $res = M('goods_type')->validate($validate)->create();

            //判断是否接收成功
            if($res === false){
                return $this->error(M('goods_type')->getError());
            }

            //添加
            $id = M('goods_type')->add();

            //判断是否添加成功
            if(empty($id)){
                return $this->error('添加失败');
            }
            return $this->success('添加成功',U('index'));
        }
        $this->display();
    }

    public function edit()
    {
        //判断是否有接收到id
        if(empty(I('get.id'))){
            return $this->error('参数错误');
        }

        if(IS_POST){
            //验证
            $validate = [
                ['type_name','require','规格名称不能为空'],
                ['type_name','type_name','该规格名称已存在',1,'unique']
            ];

            $_POST['id']=I('get.id');
            //接收数据
            $res = M('goods_type')-> validate($validate)->create();

            //判断是否接收成功
            if($res === false){
                return $this->error(M('goods_type')->getError());

            }

            //修改
            $row = M('goods_type')->where(['id'=>I('get.id')])->save();

            //判断是否修改成功
            if(empty($row)){
                return $this->error('修改失败');
            }
            return $this->success('修改成功',U('index'));

        }

        //查询数据
        $info= M('goods_type')->find(I('get.id'));
        //传递数据
        $this->assign('info',$info);
        $this->display('add');
    }

    public function delete()
    {
        //判断是否接收成功
        if(empty(I('id'))){
            return $this->error('参数错误');
        }

        //删除
        $res = M('Goods_type')->delete(I('id'));

        //判断是否删除成功
        if(empty($res)){
            return $this->error('删除失败');
        }
        return $this->success('删除成功',U('index'));
    }
}