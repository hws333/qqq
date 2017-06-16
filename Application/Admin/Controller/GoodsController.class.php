<?php
   namespace Admin\Controller;

   class GoodsController extends BaseController{
       public function index(){
        //搜索框
        $keywords=I('keywords');
        //组合表
//        $join= D('Goods')->query('select * from goods inner join category inner join brand on goods.category_id=category.id and goods.brand_id=brand.id');
        // dump($join);
        $map=[];
        if (!empty($keywords)) {
          $map['goods_name']=['like',"%{$keywords}%"];
          $map['brand_name']=['like',"%{$keywords}%"];
          $map['cate_name']=['like',"%{$keywords}%"];
          $map['_logic'] = 'OR';
        }

        //分页
        $count=D('Goods')->join('inner join category ON goods.category_id=category.id')->join('inner join brand ON goods.brand_id=brand.id')->field('goods.*,brand.brand_name as bname,category.cate_name as cname')->where($map)->count();
        $showpage=2;
//        echo $count;die;

        $page = new \Think\Page($count,$showpage);
        $this->assign('page',$page->show());

          //查询商品信息
          $info=D('Goods')->join('inner join category ON goods.category_id=category.id')->join('inner join brand ON goods.brand_id=brand.id')->field('goods.*,brand.brand_name as bname,category.cate_name as cname')->where($map)->page(I('p',1),$showpage)->order('goods.id desc')->select();


          $this->assign('info',$info);
          $this->display();
       }

       public function add(){

        if (IS_POST) {
//            dump(I());
          $res=D('Goods')->goods_add();
//            dump($res);
//            return;
          if ($res=== true) {
            return $this->success('添加成功',U('index'));
          }else{
            return $this->error($res);
          }
        }
          //查询品牌信息
          $brand=M('brand')->select();
          $this->assign('brand',$brand);

          //查询分类信息
          $category=M('category')->select();
          $cate=cate_tree($category);
          $this->assign('cate',$cate);

           //查询模型
           $goods_type=M('goods_type')->select();
           //找出相对应的规格和规格选项
           foreach ($goods_type as $k => $v) {
               $goods_type[$k]['spec']=D('Spec')->where(['type_id'=>$v['id']])->relation('spec_item')->select();
           }
           $this->assign('goods_type',$goods_type);

           $this->display();

       }

       public function edit(){
          if (empty(I('get.id'))) {
            return $this->error('参数错误');
          }

           if(IS_POST){
//              dump(I());
               $res=D('Goods')->goods_edit();
//              dump($res);return;
               if($res!==true){
                   return $this->error($res);
               }
               return $this->success('修改成功',U('index'));

           }

           $id=I('id');
           //查找要修改的商品信息
           $info=D('Goods')
               ->relation(['brand','category','goods_desc','goods_pic','goods_spec'])
               ->find($id);
           $this->assign('goods',$info);
// dump($info);
           //查找规格
           $spec=[];
           $item_id=[];
           $spec_id=[];
           $spec_stock=[];
           foreach($info['goods_spec'] as $k => $v){
                $spec[$v['spec_key']]=$v['spec_price'];

               //把spec_key转换成数组
                $spec_key=explode(',',$v['spec_key']);
               //把$spec_key与$spec_id合并
               $item_id=array_merge($item_id,$spec_key);

               //获取规格id
               $specid=explode(',',$v['spec_id']);
               //把$spec_id与$specid合并
               $spec_id=array_merge($spec_id,$specid);

               //获取库存
               $spec_stock[$v['spec_key']]=$v['spec_stock'];
           }
           $item_id=array_unique($item_id);
           $spec_id=array_unique($spec_id);
          // dump($spec);

         $spec_group=$this->handel_group($item_id,$spec_id,$spec,$spec_stock);
         // dump($id);
           $this->assign('spec_group',$spec_group);

           //查询品牌信息
           $brand=M('brand')->select();
           $this->assign('brand',$brand);

           //查询分类信息
           $category=M('category')->select();
           $cate=cate_tree($category);
           $this->assign('cate',$cate);

           //查询模型
           $goods_type=M('goods_type')->select();
           //找出相对应的规格和规格选项
           foreach ($goods_type as $k => $v) {
               $goods_type[$k]['spec']=D('Spec')->where(['type_id'=>$v['id']])->relation('spec_item')->select();
           }
           $this->assign('goods_type',$goods_type);

//           dump($info);
           $this->display('add');
       }

       public function delete(){
           $id=I('id');
            //判断是否有接受到id
           if(empty($id)){
               return $this->error('参数错误');
           }

           $res=D(Goods)->goods_del();
           if($res!==true){
               return $this->error($res);
           }
           return  $this->success('删除成功',U('index'));
       }

//        public function uploadify($filename='img'){
// //           $config=[
// //               'maxSize' => 2*1024*1024,
// //               'exts' => ['jpg','gif','jpeg','png','bmp'],
// //               'rootPath' => './Public/Upload/',
// //               'saveName'=> time().mt_rand(0,100000),
// //           ];

// //           //图片上传
//            $upload = new \Think\Upload();
//            $upload->maxSize =2*1024*1024;
//            $upload->exts = ['jpg','gif','jpeg','png','bmp'];
//            $upload->rootPath = 'Public/Upload/';
//            $upload->saveName = time().mt_rand(0,100000);

//            //判断路径是否存在，不存在则自动创建
//            if(!is_dir($upload->rootPath)){
//                mkdir($upload->rootPath);
//            }

//            $img = $upload->uploadOne($_FILES[$filename]);
// //           print_r($img);return;

//            // 上传错误提示错误信息
//            if(!$upload) {
//                die(json_encode([
//                    'error'=>1,
//                    'meg'=>$upload->getError()
//                ]));
//            }

//            $path =  $upload->rootPath . $img['savepath']. $img['savename'];
//            die(json_encode([
//                'error'=>0,
//                'path'=>$path
//            ]));

//        }

//       public function add_spec(){
//         //查询模型
//         $goods_type=M('goods_type')->select();
//         //找出相对应的规格和规格选项
//         foreach ($goods_type as $k => $v) {
//             $goods_type[$k]['spec']=D('Spec')->where(['type_id'=>$v['id']])->relation('spec_item')->select();
//         }
//         $this->assign('goods_type',$goods_type);
//
//
////         $this->display('add');
//       }

       public function handel_group($specitem_id=[],$specid=[],$spec_price=[],$spec_stock=[])
       {
           //接收信息
           $id = IS_AJAX ? I('id') : $specitem_id ;
           // dump($id);
           
           $spec_id= IS_AJAX ? I('spec_id') : $specid;
           $spec_id=array_unique($spec_id);
           $spec_id_str=implode(',',$spec_id);
//            dump($spec_id_str);

           //判断用户是否有提交套餐信息
           if(empty($id)){
               return;
           }
           if(empty($spec_id)){
               return;
           }

           //查询规格选项信息
           $item=M('spec_item')->where(['id'=>['in',$id]])->select();

          $item_id=[];
          $spec_item=[];
           foreach($spec_id as $key => $val){
               foreach($item as $k => $v){
                  //以规格的id做下标，找属于他的规格选项
                   if($v['spec_id']==$val){
                    $item_id[$val][]=$v['id'];
                   }
                   //令规格选项的id作为其键名/下标
                   $spec_item[$v['id']]=&$item[$k];
               }
           }

           //获取套餐选项的排列组合
           $group=get_array_group($item_id);

           //查询规格信息
           $spec = D('Spec')->where(['id'=>['in',$spec_id]])->select();
           // dump($spec);
           //组合套餐
           $html='<table>';

           //组合标题
           $th='<tr>';
           foreach($spec as $v){
                $th.='<th width="50" style="text-align:center;">'.$v['spec_name'].'</th>';
           }
           $th.='<th style="text-align:center;" width="160">价格</th>';
           $th.='<th style="text-align:center;">库存</th>';
           $th.='<th style="text-align:center;"></th></tr>';
           $html.=$th;

           //组合套餐选项
           $td='<tr>';
          foreach($group as $k => $v){
            foreach ($v as $key => $value) {
              $td.='<td style="text-align:center;">'.$spec_item[$value]['item'].'</td>';
            }
            //对套餐id做升序排列
            asort($v);
            $item_id_str=implode(',', $v);
//              dump($item_id_str);

            $price='';
            if(isset($spec_price[$item_id_str])){
                $price=$spec_price[$item_id_str];
            }


            $stock='';
            if(isset($spec_stock[$item_id_str])){
                $stock=$spec_stock[$item_id_str];
            }


            $stock='';
            if(isset($spec_stock[$item_id_str])){
                $stock=$spec_stock[$item_id_str];
            }
            // dump($stock);


            $td.='<td><input type="text" name="spec_price['.$item_id_str.']" value="'.$price.'"></td>';
            $td.='<td><input type="text" name="spec_stock['.$item_id_str.']" value="'.$stock.'"></td>';
            $td.='<td><input type="hidden" name="spec_id" value="'.$spec_id_str.'"></td></tr>';
          }
          $html.=$td;

          $html.='</table>';

//           echo "<pre>";
//           print_r($item_id);
           if(IS_AJAX){
               die($html);
           }
           return $html;

       }



   }