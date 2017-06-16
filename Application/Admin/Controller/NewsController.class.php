<?php
namespace Admin\Controller;

class NewsController extends BaseController {
     public function index(){
        //搜索框
        $keywords=I('keywords');
        // $map=[];
        if (!empty($keywords)) {
          $map['news_title']=['like',"%{$keywords}%"];
          $map['content_one']=['like',"%{$keywords}%"];
          $map['content_two']=['like',"%{$keywords}%"];
          $map['_logic'] = 'OR';
        }

        //分页
        $count=D('News')->where($map)->count();
        $showpage=2;
//        echo $count;die;

        $page = new \Think\Page($count,$showpage);
        $this->assign('page',$page->show());

        //查询新闻信息
        $info=D('News')->page(I('p',1),$showpage)->where($map)->order('news.id desc')->select();


          $this->assign('info',$info);
          $this->display();
       }

    public function add(){
        if(IS_POST){
           $res=D('News')->news_add();
           if ($res!==true) {
               return $this->error($res);
           }
           return $this->success('添加成功',U('index'));
        
//             //缩略图
//             $thumb = new \Think\Image();
//             $thumb->open($res['image']);

//             $w=309;
//             $h=182;
//             //后缀
//             $ext=$img['ext'];
//             $thu=$thumb->thumb($w, $h)->save($res['image'].'_'.$w.'*'.$h.'.'.$ext);
// //            dump($thu);die;
// //            if(empty($thu)){
// //                return $this->error('图片上传失败');
// //            }

//             $res['thumb']=$res['image'].'_'.$w.'*'.$h.'.'.$ext;


            // //判断是否增加成功
            // if(empty($id)){
            //     return $this->error('添加失败');
            // }
            // return $this->success('添加成功',U('index'));
        }
        $this->display();
    }

    public function edit(){
        if (empty(I('get.id'))) {
            return $this->error('参数错误');
        }
        if (IS_POST) {
            $res=D('News')->news_edit();
            if ($res!==true) {
                return $this->error($res);
            }
            return $this->success('修改成功',U('index'));
        }

        //查找当前要修改的新闻信息
        $news=D('News')->relation('news_pic')->find(I('id'));
        $this->assign('news',$news);

        $this->display('add');
    }

    public function delete(){
        if (empty(I('get.id'))) {
            return $this->error('参数错误');
        }
        $row=D('News')->news_del();
        if ($row!==true) {
            return $this->error($row);
        }
        return $this->success('删除成功',U('index'));
    }
}



