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
   
<div class="register">
    <div class="container">
        <div class="row">
            <div class="col-xs-10">
                <div class="col-sm-4 hidden-xs left">
                    <a href="index.html"><img src="/Public/Home/images/ico/8-logo.png" alt="8-logo.png" /></a>
                </div>

                <div class="col-sm-8 col-xs-12 right">
                    <h1><a href="javascript:history.back()"><img src="/Public/Home/images/ico/8-cloes.png" alt="8-cloes.png"/></a></h1>
                    <h2><span>注册</span></h2>
                    <form id="reg" method="post"  action="<?php echo U('Home/Login/register');?>" >
                        <p>
                            <label>用户：</label>
                            <input type="text" id="regi-user" name="username"/>
                        </p>
                        <p>
                            <label>密码：</label>
                            <input type="password" id="regi-pass" name="password" />
                        </p>
                        <p>
                            <label>确认密码：</label>
                            <input type="password" id="sure-pass" name="enterpassword"/>
                        </p>
                        <p>
                            <label>邮箱：</label>
                            <input type="email" id="regi-email"  name="email"/>
                        </p>
                        <p>
                            <label>手机：</label>
                            <input type="tel" id="regi-tel" name="tel"/>
                        </p>
                        <div class="select">
                            <p><label>所在地：</label></p>
                            <fieldset id="city_china">
                                <select class="province cxselect"  name="province" onchange="pchoice()">
                                    <option value="">请选择省份</option>
                                    <?php if(is_array($province)): foreach($province as $key=>$p): ?><option id="pro_id" value="<?php echo ($p["region_id"]); ?>"><?php echo ($p["region_name"]); ?></option><?php endforeach; endif; ?>
                                </select>

                                <select class="city cxselect"  name="city">
                                    <option value="">请选择城市</option>
                                    <?php if(is_array($city)): foreach($city as $key=>$c): ?><option value="<?php echo ($p["region_id"]); ?>"><?php echo ($p["region_name"]); ?></option><?php endforeach; endif; ?>
                                </select>

                                <select class="area cxselect"  name="area">
                                    <option value="">请选择地区</option>
                                    <?php if(is_array($area)): foreach($area as $key=>$a): ?><option value="<?php echo ($p["region_id"]); ?>"><?php echo ($p["region_name"]); ?></option><?php endforeach; endif; ?>
                                </select>

                            </fieldset>
                        </div>
                        <p>
                            <label>验证码：</label>
                            <input type="text" id="regi-ma" name="vcode"/>
                            <img src="<?php echo U('vcode');?>" onclick="this.src=this.src+'?'" alt="8-yanzheng.jpg" />
                            <img src="/Public/Home/images/ico/8-reflesh.png" onclick="codechange(this)" alt="8-reflesh.png" />
                        </p>
                        <p>
                            <label class="label"><input type="checkbox" name="agree" id="agree" value="" /><span>同意此注册协议</span></label>
                        </p>
                        <p>
                            <label></label>
                            <input type="submit" id="regi-submit"  value="确认"/>
                            <input type="reset" id="regi-reset" value="重置"/>
                        </p>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function codechange(o){
        $(o).prev().prop('src','<?php echo U("vcode");?>');
    }

    function pchoice(){
        var pid = $('#pro_id').val();
        $.post('<?php echo U("Login/getRegion");?>',{pid:pid},function(data){
                console.log(data);
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