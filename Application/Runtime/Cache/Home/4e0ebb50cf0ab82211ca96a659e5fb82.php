<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <meta name="keywords" content="百度地图,百度地图API，百度地图自定义工具，百度地图所见即所得工具" />
    <meta name="description" content="百度地图API自定义地图，帮助用户在可视化操作下生成百度地图" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo ((isset($title) && ($title !== ""))?($title):'首页'); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/media.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css"/>
    <script type="text/javascript" src="/Public/Home/js/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="/Public/Home/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Home/js/js.js" ></script>
</head>
<body>
<form action="" method="">
    <!--header-->
    <div class="index header">
        <div class="container">
            <div class="top">
                <div class="select car">
                    <a class="cart" href="<?php echo U('Car/index');?>" id="showcar">购物车<span id="headcartnum">0</span>件</a>
                    
                 <!--    <div class="hd_Shopping_list" id="Shopping_list">
                        <div class="s_cart"><em class="iconfont icon-cart2"></em><a href="#" class="cart">购物车<span>0</span>件</a></div>
                        <div class="dorpdown-layer">
                            <div class="spacer"></div> -->
                            <!--<div class="prompt"></div><div class="nogoods"><b></b>购物车中还没有商品，赶紧选购吧！</div>-->
                      <!--       <ul class="p_s_list">     
                                <li>
                                    
                                    <div class="content"><p><a href="#">产品名称</a></p><p>颜色分类:紫花8255尺码:XL</p></div>
                                    <div class="Operations">
                                    <p class="Price">￥55.00</p>
                                    <p><a href="#">删除</a></p></div>
                                </li>
                            </ul>       
                            <div class="Shopping_style">
                                <div class="p-total">共<b>1</b>件商品　共计<strong>￥ 515.00</strong></div>
                                <a href="Shop_cart.html" title="去购物车结算" id="btn-payforgoods" class="Shopping">去购物车结算</a>
                            </div>   -->
             <!--            </div>
                    </div>
                    <script type="text/javascript">
                  $(document).ready(function(){
                      $('.s_cart').mousemove(function(){
                      $(this).siblings('.dorpdown-layer').show();//you can give it a speed
                      });
                      $('.s_cart').mouseleave(function(){
                      $(this).siblings('.dorpdown-layer').hide();
                      });
                     // $(function(){
                     //    $(".fixed_qr_close").click(function(){
                     //        $(".mod_qr").hide();
                     //    })
                    });
                    </script> -->
                    
                    <a href="<?php echo U('Login/index');?>">登录</a>/
                    <a href="<?php echo U('Login/register');?>">注册</a>
                </div>
            </div>

            <!--导航栏-->
            <!--logo-->
            <div class="logo">
                <a href="index.html"><img src="/Public/Home/images/common/top_logo.png" alt="logo.png" /></a>
            </div>
            <!--logo-end-->

            <a href="javascript:;" class="nav_toggle"><span></span><span></span><span></span></a>
            <div class="nav">
                <ul class="navbar">
                    <li <?php if((CONTROLLER_NAME) == "Index"): ?>class="default"<?php endif; ?>><a href="\">首页</a></li>
                    <li <?php if((CONTROLLER_NAME) == "Introduction"): ?>class="default"<?php endif; ?>><a href="<?php echo U('Introduction/index');?>">品牌介绍</a></li>
                    <li <?php if((CONTROLLER_NAME) == "News"): ?>class="default"<?php endif; ?>><a href="<?php echo U('News/index');?>">新闻中心</a></li>
                    <li <?php if((CONTROLLER_NAME) == "Goods"): ?>class="default"<?php endif; ?>><a href="<?php echo U('Goods/index');?>">产品中心</a></li>
                    <li <?php if((CONTROLLER_NAME) == "Contact"): ?>class="default"<?php endif; ?>><a href="<?php echo U('Contact/index');?>">联系我们</a></li>
                </ul>
                <span></span>
                <input type="text" name="search" id="search"/>
            </div>
            <!--导航栏end-->
        </div>
    </div>
    <!--header-end-->
<script type="text/javascript">
 $(document).ready(function(){
        $('#showcar').hover(function() {
            $("#b").css('display', 'block');
        }, function() {
           $("#b").css('display', 'none');
        });
    })
 $(function(){
     $.post('<?php echo U("Car/headcar");?>',{}, function (data) {
         $('.cart #headcartnum').html(data.statistic.number);
     },'json');
 })
</script>
   

<div class="cart">
    <div class="container">
        <ul class="car-nav row">
            <li class="col-xs-4">购物车</li>
            <li class="col-xs-4">确认订单</li>
            <li class="col-xs-4">完成订单</li>
        </ul>
        <br />
        <h3><img src="/Public/Home/images/ico/10-cart-title.jpg" alt="10-cart-title.jpg" />购物车</h3>
        <div class="row allCheck">
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label>
                    <input type="checkbox" id="checkAll" onclick="checkall(this)" /> 全选
                </label>
            </div>
            <div class="col-md-2 col-sm-3 hidden-xs">
                商品
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs">
                商品信息
            </div>
            <div class="col-md-2 hidden-sm hidden-xs">
                单价
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs">
                数量
            </div>
            <div class="col-md-2 col-sm-2 hidden-xs">
                操作
            </div>
        </div>
        <!--cart-list-->
        <div class="cart-list row">
            <ul>
                <?php if(is_array($list)): foreach($list as $key=>$v): $price = !empty($v['spec_price']) ? $v['spec_price'] :$v['shop_price']; $stock = !empty($v['spec_stock']) ? $v['spec_stock'] :$v['stock']; ?>
                
                <li class="col-sm-12 ">
                    <div class="col-md-2 col-sm-3 left1">
                        <label>
                            <input type="checkbox" name="check" id="check" value="<?php echo ($v["id"]); ?>" onclick="choose(this)" <?php if(($v["status"]) == "1"): ?>checked<?php endif; ?> style="width: 20px; height: 20px;" />
                        </label>
                        <a href="<?php echo U('Goods/pro_details',['id'=>$v['goods_id']]);?>"><img src="/<?php echo ($v["image"]); ?>" style="width: 101px;height: 110px;" /></a>
                    </div>

                    <div class="col-md-2 col-sm-3">
                        <p><a href="<?php echo U('Goods/pro_details',['id'=>$v['goods_id']]);?>"><?php echo ($v["goods_name"]); ?></a></p>
                    </div>
                    <div class="col-md-2 col-sm-2 ">
                        <p>颜色：白色</p>
                        <p>套餐一</p>
                    </div>
                    <div class="col-md-2 hidden-sm">
                        <p >￥：<span class="price"><?php echo ($price); ?></span></p>
                        <p>特价</p>
                    </div>
                    <input id="stock" type="hidden" name="stock" value="<?php echo ($stock); ?>">
                    <div class="col-md-2 col-sm-2">
                        <span class="reduce">-</span>
                        <input type="text" id="number" value="<?php echo ($v["number"]); ?>" onchange="goods_num(this)" />
                        <span class="add">+</span>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <p><a href="javascript:;">移入收藏夹</a></p>
                        <p class="dele"><a href="javascript:;">删除</a></p>
                    </div>
                </li><?php endforeach; endif; ?>
            </ul>
        </div>
        <!--cart-list-end-->
        <div class="all">
            <p>共<span class="total_num" style="color: #fff;"><?php echo ($statistic["number"]); ?></span>件商品，商品应付金额：<span >￥<span class="total_price"><?php echo ($statistic["count"]); ?></span></span></p>
            <a class="button" href="javascrip:;" onclick="gotopay()">立即结算</a>
        </div>

    </div>
</div>
<script type="text/javascript">

    //输入框的中数量
    function goods_num(o){
        var num = $(o).val();
        var stock = $(o).parent().prev().val();
        alert(num);
        
        if (num <=1) {
            num = 1;
        }
        if (num >= stock) {
            alert('购买的商品数量不能超过库存量');
            num = stock;
        }
        var id=$(o).parents('li').find('#check').val();
        // alert(id);
        $.post('<?php echo U("Home/Car/textnum");?>',{
            id:id,
            number:num,
        },function(data) {
            console.log(data);
            $('.total_price').html(data.statistic.count);
            $('.total_num').html(data.statistic.number);
            $(o).val(data.num);
            //修改头部购物车信息
            $('.cart #headcartnum').html(data.statistic.number);
        },'json'
        );
    }

    //减少数量*********************************
    $(".cart .cart-list ul li div .reduce").click(function(){
    
        $(this).parents("li").find(".left1").find("label").find("input").prop("checked",true);
        $(this).parents("li").find(".left1").find("label").addClass("default");
        var num1=parseInt($(this).siblings("#number").val());
        num1--;
        if(num1<1){return}
        $(this).siblings("#number").val(num1);  

        var id=$(this).parents('li').find('#check').val();
        // alert(num1);
        $.post('<?php echo U("Home/Car/mins");?>',{
            id:id,
            number:num1
        },function(data) {
            // console.log(data);
            $('.total_price').html(data.statistic.count);
            $('.total_num').html(data.statistic.number);
            //修改头部购物车信息
            $('.cart #headcartnum').html(data.statistic.number);
        },'json'
        );

         // getTotal()
         check()
    });

    //增加数量*********************************
    $(".cart .cart-list ul li div .add").click(function(){
        var stock = $(this).parent().prev().val();
        // alert(stock);
        $(this).parents("li").find(".left1").find("label").find("input").prop("checked",true);
        $(this).parents("li").find(".left1").find("label").addClass("default")
        var num1=parseInt($(this).siblings("#number").val());
        num1++;
        if(num1>stock){
            alert('购买的商品数量不能超过库存量');
            num1=stock;}
        $(this).siblings("#number").val(num1);

        var id=$(this).parents('li').find('#check').val();
        // alert(num1);
        $.post('<?php echo U("Home/Car/plus");?>',{
            id:id,
            number:num1,
        },function(data) {
            // console.log(data);
            $('.total_price').html(data.statistic.count);
            $('.total_num').html(data.statistic.number);
            //修改头部购物车信息
            $('.cart #headcartnum').html(data.statistic.number);
        },'json'
        );

         // getTotal()
         check()
    });

    //删除*********************************
    $(".cart .cart-list .dele").click(function(){
        $(this).parents(".cart .cart-list li").remove();

        var id=$(this).parents('li').find('#check').val();
        $.post('<?php echo U("Home/Car/del");?>',{
            id:id
        },function(data) {
            alert(data.msg);
            if (data.code==0){
                return false;
            }
            $('.total_price').html(data.statistic.count);
            $('.total_num').html(data.statistic.number);
            //修改头部购物车信息
            $('.cart #headcartnum').html(data.statistic.number);
        },'json'
        );  
         // getTotal()
         check()
    });

    //多选框选中时
    function choose(o){
        //多选框属性是否选中
        var checked = $(o).prop('checked');

//        //根据多选框属性判断选中状态
//        var status = checked== true ? 1 : 0;
//        alert(status);
        var id = $(o).val();
        $.post('<?php echo U("Car/choose");?>',{
            id:id,
            checked:checked
        },function(data){
            if(data.code==1){
                $('.total_price').html(data.statistic.count);
                $('.total_num').html(data.statistic.number);
            }
        },'json');
    }

    //全选
    // $(".cart .allCheck #checkAll").click(function(){
    //     $('.cart .cart-list li label input').prop("checked", $(".cart .allCheck #checkAll").prop("checked"));
    //     $('.cart .cart-list li label input').each(function () {
    //         choose(this);
    //     })
    // });

    function checkall(o){
        var id=[];
         var checked = [];
        $('.cart .cart-list li label input').prop("checked", $(".cart .allCheck #checkAll").prop("checked"));
        $('.cart .cart-list li label input').each(function () {
            checked.push($(this).prop("checked"));
            id.push($(this).val());
        })
        $.post('<?php echo U("Car/chooseAll");?>',{
                id:id,
                checked:checked
            },function(data){
                console.log(data);
                if (data.code==0) {
                    alert(data.msg);
                    return false;
                }
                
                $('.total_price').html(data.statistic.count);
                $('.total_num').html(data.statistic.number);

            },'json');
        
    }

    //点击立即结算时判断是否有登录
    function gotopay(){
        $.post('<?php echo U("Car/login");?>',{},function(data){
                if(data.code==0){
                    alert(data.msg);
                    window.location.href=data.url;
                    return false;
                }
                window.location.href=data.url;
        },'json');
    }

</script>

<div class="footer">
    <ul class="container">
        <li>share：
            <a href="javasrcipt:;"><img src="/Public/Home/images/common/footer_QQ.png" alt="QQ"/></a>
            <a href="javasrcipt:;"><img src="/Public/Home/images/common/footer_weibo.png" alt="weibo"/></a>
            <a href="javasrcipt:;"><img src="/Public/Home/images/common/footer_weixin.png" alt="weixin"/></a>
        </li>
        <li>Copyright © 2004 Adobe Systems Incorporated. All rights reserved.</li>
    </ul>
</div>
</form>
</body>
</html>