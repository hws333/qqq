<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class NewsController extends Controller {
    public function index(){
        $count=M('news')->count();
        $showpage=4;

        $page=new \Think\Page($count,$showpage);
        dump($page->show());
        $this->assign('page',$page->show());

        $news=D('News')
            ->field('id,news_title,image,create_time,content_one')
            ->page(I('p',1),$showpage)
            ->order('id desc')
            ->select();
        $this->assign('news',$news);

        $title='新闻中心';
        $this->assign('title',$title);

        $this->display();
    }

    public function details(){
        $id=I('id');
        $details= D('News')
            ->relation('news_pic')
            ->field('id,content_one,content_two,news_title')
            ->find($id);
        $this->assign('details',$details);

        $title='新闻详情';
        $this->assign('title',$title);

        //查找下一篇数据
        $down = $this->updown("id < $id",'desc');
        $this->assign('down',$down);

        //查找最下一篇的数据
        $maxdown = $this->updown('','asc');
        $this->assign('maxdown',$maxdown);

        //查找最上一篇的数据
        $maxup = $this->updown('','desc');
        $this->assign('maxup',$maxup);

        //查找上一篇数据
        $up = $this->updown("id > $id",'asc');
        $this->assign('up',$up);

        $this->display();
    }

    protected function updown($where='',$order){
        return M('news')
            ->field('id,news_title')
            ->where($where)
            ->order('id '.$order)
            ->limit(1)
            ->find();
    }
}
