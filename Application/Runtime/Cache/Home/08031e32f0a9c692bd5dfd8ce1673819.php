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
   
<form action="" method="">
    <!--contain-->
    <div class="pro_details">
        <div class="container">
            <!--title-->
            <div class="title">
                <h3><span>产品中心</span></h3>
                <h4>PRODUCT  CENTER</h4>
                <p>
                    当前位置 : <a href="<?php echo U('Index/index');?>">首页</a>><a href="<?php echo U('index');?>">产品中心</a>产品详情
                    <span>阅读量：66666</span>
                </p>
            </div>
            <!--title-end-->
            <div class="center">
                <ul class="pro-navbar row">
                    <ul class="pro-navbar row">
                        <li class="default col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>3]);?>">新品上市</a></li>
                        <li class="col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>4]);?>">MP4系列</a></li>
                        <li class="col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>10]);?>">MP3系列</a></li>
                        <li class="col-sm-3 col-xs-6"><a href="<?php echo U('index',['cid'=>5]);?>">促销系列</a></li>
                    </ul>
                </ul>
                <div class="detail">
                    <div class="pic">
                        <p><img src="/<?php echo ($details["image"]); ?>" alt="6-pro_details0" style="width: 480px;height: 553px;"/></p>
                        <ul class="row">
                            <?php if(is_array($details["goods_pic"])): foreach($details["goods_pic"] as $key=>$pic): ?><li class="col-sm-3 col-xs-3">
                                    <img src="/<?php echo ($pic["photo"]); ?>" alt="6-pro_details-0.jpg" style="width: 109px;height: 123px;"/>
                                </li><?php endforeach; endif; ?>
                        </ul>
                        <dl>
                            <dd> <a href="javascript:;"><img src="/Public/Home/images/ico/6-share.png" alt="6-share.png"/>&nbsp;&nbsp;分享</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;"><img src="/Public/Home/images/ico/6-collect.png" alt="6-collect.png"/>&nbsp;&nbsp;收藏商品 （37006人气）</a></dd>
                            <dd><a href="javascript:;">举报</a></dd>
                        </dl>
                    </div>
                    <div class="text">
                        <h3><?php echo ($details["goods_name"]); ?></h3>
                        <h4>蓝牙功能 一百小时播放 HIFI无损 </h4>
                        <p class="much">原价：    <span>¥ <?php echo ($details["market_price"]); ?></span></p>
                        <p >抢购价：  ¥ <b id="desc_price"><?php echo ($details["shop_price"]); ?></b></p>
                        <dl class="dl">
                            <dt>颜色分类 :</dt>
                            <dd>
                                <ul class="color row">
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-1.png" alt="6-color-1.png" />
                                    </li>
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-2.png" alt="6-color-2.png" />
                                    </li>
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-3.png" alt="6-color-3.png" />
                                    </li>
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-4.png" alt="6-color-4.png" />
                                    </li>

                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-5.png" alt="6-color-5.png" />
                                    </li>
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-6.png" alt="6-color-6.png" />
                                    </li>
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-7.png" alt="6-color-7.png" />

                                    </li>
                                    <li class="col-sm-3 col-xs-4">
                                        <img src="/Public/Home/images/ico/6-color-8.png" alt="6-color-8.png" />
                                    </li>
                                </ul>
                            </dd>

                        </dl>
                        <?php if(is_array($spec)): foreach($spec as $k=>$s): ?><dl class="type">
                            <dt><?php echo ($k); ?></dt>
                            <dd>
                                <ul class="row">
                                    <?php if(is_array($s)): foreach($s as $key=>$i): ?><li class="col-sm-3 col-xs-3">
                                        <a <?php if(empty($key)): ?>class="default"<?php endif; ?> href="javascript:;" data-item-id="<?php echo ($i["id"]); ?>" data-item-spec_id="<?php echo ($i["spec_id"]); ?>"><?php echo ($i["item"]); ?></a>
                                    </li><?php endforeach; endif; ?>
                                    <!--<li class="col-sm-3 col-xs-3">-->
                                        <!--<a href="javascript:;">套餐一</a>-->
                                    <!--</li>-->
                                    <!--<li class="col-sm-3 col-xs-3">-->
                                        <!--<a href="javascript:;">套餐二</a>-->
                                    <!--</li>-->
                                    <!--<li class="col-sm-3 col-xs-3">-->
                                        <!--<a class="default" href="javascript:;">套餐三</a>-->
                                    <!--</li>-->
                                </ul>
                                <div id="show"></div>
                            </dd>

                        </dl><?php endforeach; endif; ?>
                        <dl class="number">
                            <dt>数量：</dt>
                            <dd>
                                <input type="text" id="num" value="1"/>
										<span>
											<span class="add"><img src="/Public/Home/images/ico/6-add.png" alt="6-add.png"/></span>
											<span class="reduce"><img src="/Public/Home/images/ico/6-reduce.png" alt="6-reduce.png"/></span>

										</span>
                            </dd>
                            <dd>件</dd>
                            <dd id="stock">库存<?php echo ($details["stock"]); ?>件</dd>
                        </dl>
                        <p class="chan">已选择“<small><a href="javascript:;">蓝色套餐三 （1）件</a></small>”</p>
                        <p id="addtocar"><a class="button" href="confirm_order.html">立即购买</a><a class="button" href="#" onclick="addtocar(<?php echo ($details["id"]); ?>)">加入购物车</a></p>
                        <dl class="simply">
                            <dt>规格参数：</dt>
                            <?php echo ($details["goods_desc"]["content"]); ?>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--contain-end-->
</form>
<script>
    //----------------详情信息------------------------
    $(function(){
        get_group_price();
    });
    $('.type ul li a').click(function(){
            $(this).parents('li').siblings().find('a').removeClass('default');
            $(this).toggleClass('default');

            get_group_price();
        });
    function get_group_price(){
        var spec_key=[];
        //遍历选中的选项id
        $('.type ul li a.default').each(function(){
            spec_key.push($(this).attr('data-item-id'));
        });

        var id=<?php echo ($_GET['id']); ?>;
        $.get('<?php echo U("Goods/AjaxGetGroup");?>',{spec_key:spec_key.sort(sortNumber).join(','),id:id},function(data) {
            console.log(data);
            var price=data.spec_price;
            var stock=data.spec_stock;
            if(price.length!=0){
                $('#desc_price').html(data.spec_price);
            }
            if(stock.length!=0){
                $('#stock').html('库存'+data.spec_stock+'件');
            }

        },'json'
        );
    }

    function sortNumber(a,b){
        return a - b;
    }

    //----------------购物车------------------------
    function addtocar(gid){
        var num = $('#num').val();
        var spec_key=[];
        //遍历选中的选项id
        $('.type ul li a.default').each(function(){
            spec_key.push($(this).attr('data-item-id'));
        });

        // alert(gid);
        $.post('<?php echo U("Car/add");?>',{
            goods_id:gid,
            number:num,
            goods_spec_key:spec_key.sort(sortNumber).join(',')
        },function(data){
            console.log(data);
            alert(data.msg);
            if (data.code==0) {
                return false;
            }

            //修改头部购物车信息
            $('.cart #headcartnum').html(data.statistic.number);
            
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