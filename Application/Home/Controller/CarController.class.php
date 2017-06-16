<?php
namespace Home\Controller;

class CarController extends \Think\Controller{
/*create table car(
id int unsigned not null auto_increment primary key,
goods_id int unsigned not null,
number int unsigned not null,
user_id int unsigned not null,
user_key char(30) not null,
goods_spec_key char(50) not null
)*/
    protected $user_key=null;

    //初始化给每个用户唯一的标识
    public function _initialize()
    {
        $this->user_key = cookie('user_key');
        if(empty($this->user_key)){
            $this->user_key=md5(uniqid(rand(),true));
            cookie('user_key',$this->user_key,3600*24*7);
        }
    }

    public function index(){
        //查找购物车商品
        $list=$this->getCarList();
        $this->assign('list',$list);
         dump($list);

//        统计商品总数及总价
        $statistic=$this->statistic();
        $this->assign('statistic',$statistic);
         dump($statistic);

        $title='购物车';
        $this->assign('title',$title);


//        $statistic=$this->statistic();

        $this->display();
        // dump($this->getGoods(16,'150,23'));

        // dump($this->add(16,10,'150,23'));
    }

    public function add($goods_id,$number=1,$goods_spec_key){
        if (!IS_AJAX) {
            return $this->error('请求错误');
        }

        //判断要添加的商品是否存在
        $goods=$this-> getGoods($goods_id,$goods_spec_key);
        // dump($goods);
        if (empty($goods)) {
            // return $this->error('该商品不存在');
            die(json_encode(['code'=>0,'msg'=>'该商品不存在']));
        }

        //判断添加的数据是否存在于购物车，不存在则添加整条数据信息，存在则令购物车中该条商品数量增加
        //查找商品
        $car_goods=$this->getCarGoods($goods_id,$goods_spec_key);
//        dump($car_goods);return;

        if(empty($car_goods)){
            if (!empty($goods_spec_key)) {

            }

            //组装数据
            $data=[
                'goods_id'=>$goods_id,
                'number'=>$number,
                'user_key'=>$this->user_key,
                'goods_spec_key'=>$goods_spec_key,
                'status'=>1
            ];
//            dump($data);return;
            //添加数据
            $res = M('car')->add($data);
        }else{
            $num=$car_goods['number']+$number;
            $res=$this->saveCar($car_goods['id'],['number'=>$num]);
        }

        //判断是否添加成功
        if(empty($res)){
            // return $this->error('添加到购物车失败');
            die(json_encode(['code'=>0,'msg'=>'添加到购物车失败']));
        }
        // return $this->success('添加到购物车成功',U('Goods/index'));
        die(json_encode(['code'=>1,'msg'=>'添加到购物车成功','statistic'=>$this->statistic()]));
    }

    //修改购物车信息
    protected function saveCar($id=0,$data){
        if(isset($data['number'])&&$data['number']<=1){
            $number=1;
        }
        $data['id']=$id;
        $car_row = M('car')->save($data);

        return $car_row;

    }

    //获取要添加到购物车的数据
    protected function getGoods($goods_id,$goods_spec_key){
        $map=[];
        
        $goods=D('Goods')
            ->relation(['goods_spec','spec_item'])
            ->field('id,goods_name,image,shop_price,market_price,stock')
            ->where($map)
            ->find($goods_id);
        //判断规格
        if (!empty($goods_spec_key)) {
            $state=[];
            foreach($goods['goods_spec'] as $k => $v){
                if($goods_spec_key===$v['spec_key']){
                    $state[]=true;
                }else{
                    $state[]=false;
                    unset($goods['goods_spec'][$k]);
                }
            }
            if (empty($goods['goods_spec'])) {
                unset($goods);
            }
        }
       return $goods;
    }

    //获取购物车总价及总数量
    protected function statistic(){
        $list = $this->getCarList();
        $count=0;
        $num=0;
        //判断商品是否有套餐，有则单价为套餐价,没有则单价为商店价
        foreach($list  as $k => $v){
            if($v['status']== '1'){
                $price = !empty($v['spec_price']) ? $v['spec_price'] : $v['shop_price'];
                $count += $price * $v['number'];
                $num += $v['number'];
            }
        }
        return ['count'=>$count,'number'=>$num];
    }

    // 获取购物车列表
    protected function getCarList(){
        $map=['user_key'=>$this->user_key];
        $list=M('Car as c')
            ->field('c.*,g.market_price,g.shop_price,g.image,g.goods_name,gc.spec_price,g.stock,gc.spec_stock')
            ->join('left join goods as g on g.id=c.goods_id')
            ->join('left join goods_spec as gc on gc.goods_id=c.goods_id and gc.spec_key=c.goods_spec_key')
            ->where($map)
            ->order('id desc')
            ->select();
        return $list;
//        $list1=D('Car')
//            ->relation(['goods','goods_spec'])
//            ->where($map)
//            ->select();

    }

    //获取购物车单条商品信息
    protected function getCarGoods($goods_id,$goods_spec_key=''){
        $map=[
            'goods_id'=>$goods_id,
            'user_key'=>$this->user_key,
        ];

        //判断商品是否规格
        if(!empty($goods_spec_key)){
            $map['goods_spec_key']=$goods_spec_key;
        }

        //查找商品
        $car_goods=M('car')
            ->where($map)
            ->find();
        return $car_goods;
    }

    //删除购物车商品
    public function del($id){
        M()->startTrans();
        $row = M('car')->delete($id);
        if(empty($row)){
            M()->rollback();
            // return $this->error('删除商品失败');
            die(json_encode(['code'=>0,'msg'=>'删除商品失败']));
        }
        M()->commit();
        // return $this->success('删除商品成功');
        die(json_encode(['code'=>1,'msg'=>'删除商品成功','statistic'=>$this->statistic()]));

    }

    //增加购物车数量
    public function plus($id,$number){
        $this->saveCar($id,['number'=>$number]);
        die(json_encode(['list'=>$this->getCarList(),'statistic'=>$this->statistic()]));
    }

    //减少购物车数量
    public function mins($id,$number){
        $this->saveCar($id,['number'=>$number]);
        die(json_encode([
            'list'=>$this->getCarList(),'statistic'=>$this->statistic()]));
    }

    public function textnum($id,$number)
    {
        $this->saveCar($id,['number'=>$number]);
        die(json_encode([
            'num'=>$number,
            'list'=>$this->getCarList(),
            'statistic'=>$this->statistic()]));
    }

    //头部购物车处理
    public function headcar(){
        die(json_encode([
            'list'=>$this->getCarList(),
            'statistic'=>$this->statistic(),
            ]));
    }

    //多选框
    public function choose(){
        if(IS_AJAX){
//            print_r(I());
            $id=I('post.id');
//            print_r($id);
            $checked=I('post.checked');
            $status = $checked == 'true' ? 1 :0;
//            print_r($status);return;
            $row = $this->saveCar($id,['status'=>$status]);
            die(json_encode([
                'code'=>1,
                'list'=>$this->getCarList(),
                'statistic'=>$this->statistic()
            ]));
        }
    }

    public function chooseAll(){

        // print_r(I());return;
        if (!IS_AJAX) {
            die(json_encode(['code'=>0,'msg'=>'请求错误']));
        }
        $id=I('post.id');
        $checked=I('post.checked');
        $status=[];
        foreach ($checked as $key => $value) {
            $status[] = $value == 'true' ? 1 :0;
            $this->saveCar($id[$key],['status'=>$status[$key]]);
        }
// die;
        $list=$this->getCarList();
        $statistic=$this->statistic();
        die(json_encode([
            'code'=>1,
            'list'=>$list,
            'statistic'=>$statistic
            ]));

    }

    //判断用户是否用登录
    public function login(){
        if(IS_AJAX){
            if(empty($_SESSION['coustomer'])){
                die(json_encode(['code'=>0,'msg'=>'请登录','url'=>U('Login/index')]));
            }
            die(json_encode(['code'=>1,'url'=>U('Order/index')]));
        }
    }


}