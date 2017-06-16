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
   
<script type="text/javascript" src="/Public/Home/js/baidu.js"></script>
<!--引用百度地图API-->
<style type="text/css">
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
	.anchorBL{ display:none; }
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>

<!--contain-->
<div class="contact_us">
	<div class="container">
		<!--title-->
		<div class="title">
			<h3><span>联系我们</span></h3>
			<h4>CONTACT  US</h4>
			<p>
				当前位置 : <a href="/">首页</a>>联系我们
				<span>阅读量：66666</span>
			</p>
			
		</div>
		<!--title-end-->
		<!--map-->
		<div id="dituContent">
			
		</div>
		<!--map-end-->
		<div class="row">
			<div class="col-sm-6">
				<p>公司：<?php echo ($set["company_name"]); ?></p>
				<p>电话：<?php echo ($set["tel"]); ?> <span></span><i>传真：<?php echo ($set["fax"]); ?></i></p>
				<p>邮箱：<?php echo ($set["email"]); ?></p>
				<p>地址：<?php echo ($set["address"]); ?></p>
				<p>网址：<?php echo ($set["web"]); ?></p>
				<div class="pic">
					<img src="/<?php echo ($set["image"]); ?>" />
					<p>扫一扫</p>
				</div>
			</div>
			<div class="col-sm-6">
				<form action="" method="">
					<p>
						<label>用户：</label>
						<input type="text" name="user_name" id="user_name" value="" />
					</p>
					<p>
						<label>邮箱：</label>
						<input type="text" id="email" name="email" />
					</p>
					<p>
						<label>手机号码：</label>
						<input type="text" id="tel" name="tel" />
					</p>
					<p>
						<label>留言框：</label>
						<textarea name="content"></textarea>
					</p>
					<p>验证：<input type="text" id="yanzheng" name="code">
						<b>
							<img id="code_pic" src="<?php echo U('verify');?>" onclick="this.src=this.src+'?'" alt="code.jpg"/>
							<small onclick="codechange(this)">看不清，换一张</small>
						</b>
					</p>
					<p>
						<input type="button" name="submit" id="submit" value="提交" onclick="cta()" />
						<input type="reset" name="reset" id="reset" value="重置" />
					</p>
				
				
			</div>
		</div>
	</div>
</div>
<!--contain-end-->
</form>

<script>
	function cta() {
		var user_name = $('input[name="user_name"]').val();
		var email = $('input[name="email"]').val();
        var tel = $('input[name="tel"]').val();
        var content = $('textarea[name="content"]').val();
		var code = $('input[name="code"]').val();
        var url = '<?php echo U("index");?>';
        // alert(url);
		$.post('<?php echo U("Contact/message");?>',{
			user_name:user_name,
			email:email,
			tel:tel,
			content:content,
			code:code
		},function(data) {
			alert(data.meg);
			if(data.code==0){
				return false;
			}
			window.location.href=url;
		},'json');
	}

	function codechange(o){
		$(o).prev().prop('src','<?php echo U("verify");?>');
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