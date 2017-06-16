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
    </form>
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
   
<!--contain-->
<div class="pro_list">
    <div class="container">
        <div class="pic">
            <a href="pro_details.html"><img src="/Public/Home/images/ad/5-pro_list.jpg" alt="5-pro_list.jpg" /></a>
        </div>
        <!--title-->
        <div class="title">
            <h3><span>产品中心</span></h3>
            <h4>PRODUCT  CENTER</h4>
            <p>
                当前位置 : <a href="<?php echo U('Index/index');?>">首页</a>>产品中心
                <span>阅读量：66666</span>
            </p>
        </div>
        <!--title-end-->
        <!--center-->
        <div class="center">
            <ul class="pro-navbar row">
                <li class="default col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>3]);?>">新品上市</a></li>
                <li class="col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>4]);?>">MP4系列</a></li>
                <li class="col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>10]);?>">MP3系列</a></li>
                <li class="col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>5]);?>">促销系列</a></li>
            </ul>
            <style>
                #table tr a.on{background: white; color: black;}
            </style>
            <table id="table" border="1 solid white" rules="all"  style="margin-bottom: 10px;">
                <tr>
                    <td style="width:50px;" >品牌</td>
                    <td>
                        <?php if(is_array($brand)): foreach($brand as $key=>$b): ?><a <?php if(($b["on"]) == "1"): ?>class="on"<?php endif; ?> href="<?php echo ($b["url"]); ?>" style="margin:0 10px">
                            <?php echo ($b["brand_name"]); ?>
                            </a><?php endforeach; endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>价格</td>

                    <td>
                        <?php if(is_array($price)): foreach($price as $key=>$p): ?><a <?php if(($p["on"]) == "1"): ?>class="on"<?php endif; ?> href="<?php echo ($p["url"]); ?>" style="margin:0 10px">
                            <?php echo ($p["name"]); ?>
                            </a><?php endforeach; endif; ?>
                    </td>

                </tr>

            </table>

            <!--tab-->
            <div class="tab default">
                <ul class="row">
                    <?php if(is_array($goods)): foreach($goods as $key=>$g): ?><li class="col-sm-3 col-xs-6">
                            <div class="pro">
                                <div class="pic">
                                    <a href="<?php echo U('pro_details',['id'=>$g['id']]);?>"><img src="/<?php echo ($g["image"]); ?>" alt="5-pro_list-1.jpg" style="width: 273px; height: 352px;"/></a>
                                </div>
                                <div class="text">
                                    <p>
                                        <a href="pro_details.html"><?php echo ($g["goods_name"]); ?></a>
                                        <span>¥ <?php echo ($g["shop_price"]); ?></span>
                                    </p>

                                    <a class="cart" href="javascript:;"><img src="/Public/Home/images/ico/5-pro_list-shopcar.png" alt="image" onclick="addcart(<?php echo ($g['id']); ?>,<?php echo ($g['goods_spec'][0]['spec_key']); ?>)"/> 加入购物车</a>

                                </div>
                            </div>
                        </li><?php endforeach; endif; ?>
                </ul>
            </div>
            <!--tab-end-->
            <ul class="page">
                <?php echo ($page); ?>
                <!--<li><a href="javascript:;"><?php echo ($page); ?></a></li>-->
                <!--<li><a href="javascript:;">2</a></li>-->
                <!--<li><a href="javascript:;">3</a></li>-->
                <!--<li><a href="javascript:;">4</a></li>-->
                <!--<li><a href="javascript:;">...</a></li>-->
                <!--<li><a href="javascript:;">末页</a></li>-->
            </ul>
        </div>
        <!--center-end-->
        <script>
            function addcart(gid,spec_key){
                alert(0);
                var num = 1;
                 alert(num);
//                $.post('<?php echo U("Car/add");?>',{
//                    goods_id:gid,
//                    number:num,
//                    goods_spec_key:spec_key.sort(sortNumber).join(',')
//                    },function(data){
//                        console.log(data);
//                        alert(data.msg);
//                        if (data.code==0) {
//                            return false;
//                    }
//                //修改头部购物车信息
//                },'json');
            }

            function sortNumber(a,b){
                return a - b;
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