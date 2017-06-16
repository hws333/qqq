<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {

    public function index(){
        //找出当前分类及其子类
        $cid=I('cid',0);
        if(!empty($cid)){
            //找出当前分类
            $cate=  M('category')->field('id,pid')->select();
            //找出当前分类下的子类
            $cateson=cate_tree($cate,$cid);

            //组装当前分类及其子类的id
            $cids=[$cid];
            foreach ($cateson as $v) {
                $cids[]=$v['id'];
            }

            //查询当前分类下的品牌
            $brand=M('brand')
                ->join('__GOODS__ on brand.id=goods.brand_id')
                ->where(['goods.category_id'=>['in',$cids]])
                ->field('brand.id,brand.brand_name')
                ->fetchSql(false)
                ->group('brand.brand_name')
                ->select();
        }else{
            //查询所有品牌
            $brand=M('brand')->field('id,brand_name')->select();
        }

        //在数组前添加‘全部’选项
        array_unshift($brand,['id'=>0,'brand_name'=>'全部']);

        //处理品牌,添加url
        foreach($brand as $k => $v){
            $tmp=I('get.');
            $tmp['bid']=$v['id'];

            //当接收到的bid为0，即选中全部时，删除地址栏中bid的信息
            if($tmp['bid']==0){
                unset($tmp['bid']);
            }
            //选中的品牌的跳转地址
            $brand[$k]['url']=U('index',$tmp);

            //判断选中的品牌
            $brand[$k]['on']= I('get.bid',0)===$v['id'] ? 1 :0;
        }
//        dump($brand);
        $this->assign('brand',$brand);


        //-----------------------价格-----------------------
        $price=[
            ['name'=>'全部','value'=>'0'],
            ['name'=>'0-500元','value'=>'0-500'],
            ['name'=>'500-1000元','value'=>'500-1000'],
            ['name'=>'1000-5000元','value'=>'1000-5000'],
            ['name'=>'5000元以上','value'=>'5000'],
        ];

        //处理价格,添加url
        foreach($price as $k => $v){
            $tmp=I('get.');
            $tmp['price']=$v['value'];

            //当接收到的bid为0，即选中全部时，删除地址栏中bid的信息
            if($tmp['price']==(string)0){
                unset($tmp['price']);
            }
            //选中的品牌的跳转地址
            $price[$k]['url']=U('index',$tmp);

            //判断选中的品牌
            $price[$k]['on']= (string)I('get.price',0)===$v['value'] ? 1 :0;
        }
//        dump($price);
        $this->assign('price',$price);

        $map=[];
        if(!empty(I('cid'))){
            $map=['category_id'=>I('cid')];
        }
        if(!empty(I('bid'))){
            $map['brand_id']=['in'=>I('bid')];
        }
//        if(!empty(I('price'))){
//            $map['brand_id']=['in'=>I('bid')];
//        }

        //分页
        $count=M('goods')->where($map)->count();
        $showlist=4;
        $page = new \Think\Page($count,$showlist);
        $this->assign('page',$page->show());


        //经过筛选后的商品
        $goods=D('Goods')
            ->relation('goods_spec')
            ->where($map)
            ->field('id,goods_name,shop_price,image')
            ->order('id desc')
            ->page(I('p',1),4)
            ->select();
        $this->assign('goods',$goods);

//        echo '<pre>';
//        print_r($goods);



        $title='产品中心';
        $this->assign('title',$title);

        $this->display();
    }

    public function pro_details(){
        $id=I('id');
        if(empty($id)){
            return $this->error('网络错误');
        }
        $details=D('Goods')
            ->relation(['goods_pic','goods_desc','goods_spec'])
            ->field('id,goods_name,shop_price,market_price,image,stock')
            ->fetchSql(false)
            ->find($id);
        $this->assign('details',$details);
        dump($details);

        //套餐
        $spec_key=[];
        $spec_id=[];
        foreach($details['goods_spec'] as $k =>$v){
            $s_key=explode(',',$v['spec_key']);
            $spec_key=array_merge($spec_key,$s_key);

            $s_id=explode(',',$v['spec_id']);
            $spec_id=array_merge($spec_id,$s_id);
        }
        $spec_key=array_unique($spec_key);
        $spec_id=array_unique($spec_id);
        // dump($spec_key);
        // dump($spec_id);

        $item=M('spec_item')->where(['id'=>['in',$spec_key]])->select();

        $s=M('spec')->where(['id'=>['in',$spec_id]])->select();
//       dump($s);
        $spec=[];
        $spec_name=[];
        foreach($s as $key =>$val){
            foreach($item as $k => $v){
                if($v['spec_id']==$val['id']){
                    $spec[$val['spec_name']][]=$v;
                    $spec_name[$val['spec_name']][]=$v['item'];
                }
            }
        }

        $this->assign('spec',$spec);
        $this->assign('spec_name',$spec_name);
        dump($spec_name);


        $title='产品详情';
        $this->assign('title',$title);
        $this->display();
    }


    public function AjaxGetGroup(){
        $map=[
            'spec_key'=>I('spec_key'),
            'goods_id'=>I('id')
        ];
        die(json_encode(M('goods_spec')->where($map)->Field('spec_price,spec_stock')->find()));
    }

}
