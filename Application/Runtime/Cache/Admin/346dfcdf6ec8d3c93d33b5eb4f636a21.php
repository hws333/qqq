<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
<link rel="stylesheet" href="/Public/Admin/css/admin.css">
<script src="/Public/Admin/js/jquery.js"></script>
<script src="/Public/Admin/js/pintuer.js"></script>
<script src="/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="/Public/Admin/js/bootstrap.min.js"></script>
<link href="/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <script src="/Public/Admin/Uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/Uploadify/uploadify.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/goods_add.css">



<div class="panel admin-panel">
    <div class="panel-head" id="add">
        <strong>
            <span class="icon-pencil-square-o"></span>
            <?php if(empty($_GET['id'])): ?>增加<?php else: ?>修改<?php endif; ?>内容
        </strong>
    </div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>商品名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="goods_name" value="<?php echo ((isset($goods["goods_name"]) && ($goods["goods_name"] !== ""))?($goods["goods_name"]):''); ?>"/>
                    <div class="tips"></div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="label">
                    <label>品牌：</label>
                </div>
                <div class="field">
                    <select name="brand_id" class="input w50">
                        <option>请选择商品品牌</option>
                        <?php if(is_array($brand)): foreach($brand as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if(($val['id']) == $goods['brand_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($val["brand_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>商品分类：</label>
                </div>
                <div class="field">
                    <select name="category_id" class="input w50">
                        <option>请选择商品分类</option>
                         <?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"  <?php if(($v['id']) == $goods['category_id']): ?>selected="selected"<?php endif; ?> ><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']-1); echo ($v["cate_name"]); ?></option><?php endforeach; endif; ?>
                      
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>市场价格：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="market_price" value="<?php echo ((isset($goods["market_price"]) && ($goods["market_price"] !== ""))?($goods["market_price"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>商店价格：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="shop_price" value="<?php echo ((isset($goods["shop_price"]) && ($goods["shop_price"] !== ""))?($goods["shop_price"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>库存：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="stock" value="<?php echo ((isset($goods["stock"]) && ($goods["stock"] !== ""))?($goods["stock"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>图片：</label>
                </div>
                <div class="field">
                    <input id="file_upload" name="file_upload" type="file" multiple="true" value="+ 浏览上传">
                    <!--<input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;" onclick="uploadpic()">-->
                    <div id="queue">
                        <?php if(!empty($_GET['id'])): ?><dl style="float: left; margin-right:10px;" id="">
                            <dt style="border: 1px solid red;padding: 5px;"><img src="/<?php echo ($goods["image"]); ?>" width="100" height="100"></dt>
                            <input type="hidden" name="image" value="<?php echo ($goods["image"]); ?>">
                            <dd style="text-align: center;">
                                <button onclick="mainpic(this)" style="margin-right: 5px" type="button">主图</button>
                                <button onclick="delpic(this)" type="button">删除</button>
                                </dd>
                            </dl>
                           <?php if(is_array($goods["goods_pic"])): foreach($goods["goods_pic"] as $key=>$v): ?><dl style="float: left; margin-right:10px;">
                                   <dt style="border: 1px solid #999;padding: 5px;"><img src="/<?php echo ($v['photo']); ?>" width="100" height="100"></dt>
                                   <input type="hidden" name="pic[]" value="<?php echo ($v['photo']); ?>">
                                   <dd style="text-align: center;">
                                       <button onclick="mainpic(this)" style="margin-right: 5px" type="button">主图</button>
                                       <button onclick="delpic(this)" type="button">删除</button>
                                   </dd>
                               </dl><?php endforeach; endif; endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>规格：</label>
                </div>
                <div class="field">
                    <button type="button" id="spec_button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="add_spec()" style="margin-bottom: 10px;">
                        添加规格
                    </button>
                    <div id="spec_body" style="margin:10px 0;">
                        <style type="text/css">
                             #spec_body tr{margin-bottom:5px;}
                        </style>
                        <div>
                            <?php echo ($spec_group); ?>
                        </div>
                    </div>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">规格选项</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="spec_list">
                                        <ul class="tab">
                                            <?php if(is_array($goods_type)): foreach($goods_type as $key=>$value): ?><li <?php if(($key) == "0"): ?>class="cur"<?php endif; ?>><?php echo ($value["type_name"]); ?></li><?php endforeach; endif; ?>
                                        </ul>
                                        <div class="tab-body">
                                            <?php if(is_array($goods_type)): foreach($goods_type as $k=>$value): ?><div class="body <?php if(($key) == "0"): ?>cur<?php endif; ?>">
                                                <?php if(is_array($value['spec'])): foreach($value['spec'] as $k=>$v): ?><dl>
                                                        <dt><?php echo ($v["spec_name"]); ?></dt>
                                                        <?php if(is_array($v['spec_item'])): foreach($v['spec_item'] as $key=>$item): ?><dd  data-item-id="<?php echo ($item["id"]); ?>" data-item-spec_id="<?php echo ($item["spec_id"]); ?>"><?php echo ($item["item"]); ?></dd><?php endforeach; endif; ?>
                                                        <p style="clear: both;"></p>
                                                    </dl><?php endforeach; endif; ?>
                                                </div><?php endforeach; endif; ?>
                                         </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveitem()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="label">
                    <label>内容：</label>
                </div>
                <div class="field">
                    <!-- <div class="col-sm-10"> -->
                        <!-- 加载编辑器的容器 -->
                        <textarea id="container" name="content" type="text/plain" style="margin-right:  15px; height: 250px;"><?php echo ((isset($goods["goods_desc"]["content"]) && ($goods["goods_desc"]["content"] !== ""))?($goods["goods_desc"]["content"]):''); ?></textarea>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/Public/Admin/utf8-php/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/Public/Admin/utf8-php/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>
                    <!-- </div> -->
                    <div class="tips"></div>
                </div>
            </div>

            
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

//    function add_spec(){
//        $.ajax({
//            type:'post',
//            url:'<?php echo U("Goods/add_spec");?>',
//            data:{id:item_id,spec_id:spec_id},
//            dataType:'html',
//            success:function(data){
////                 console.log(data);
//                $('#spec_body').html(data);
//            },
//            error:function(e){
//            }
//        })
//    }

    function saveitem(){
        var item_id=[];
        var spec_id=[];
        var gid=<?php echo ($_GET['id']); ?>;
        $('.spec_list dd.cur').each(function () {
            item_id.push($(this).attr('data-item-id'));
            spec_id.push($(this).attr('data-item-spec_id'));
        })
//
        // console.log(item_id);
        // console.log(spec_id);

        $.ajax({
            type:'post',
            url:'<?php echo U("Goods/handel_group");?>',
            data:{id:item_id,spec_id:spec_id,gid:gid},
            dataType:'html',
            success:function(data){
//                 console.log(data);
                $('#spec_body').html(data);
            },
            error:function(e){
            }
        })
    }

    $('.spec_list .tab li').click(function(){
        $(this).parent().find('li').removeClass('cur');
        $(this).addClass('cur');

        //找到li所在的位置/索引
        var index = $('.spec_list .tab li').index(this);
         $('.spec_list .tab-body .body').css({display:'none'});
         $('.spec_list .tab-body .body').eq(index).css({display:'block'});
    });

//$(function () {
//    //找到li所在的位置/索引
//    var index = $('.spec_list .tab li').index(this);
//    var index2=$('.spec_list .tab-body .body').index(this);
//    $('.spec_list .tab-body .body').css({display:'none'});
//    $('.spec_list .tab-body .body').eq(index).css({display:'block'});
//})


    $('dd').click(function(){
        $(this).parents('.body').siblings().find('dd').removeClass('cur');
        $(this).toggleClass('cur');
    })

    //-----------------图片上传--------------------
    $(function() {
        $('#file_upload').uploadify({
            'buttonText' : '+ 浏览上传',
            'swf'      : '/Public/Admin/Uploadify/uploadify.swf',
            'buttonClass':'button bg-blue',
            'height':42,
            'width':102,
            'uploader' : "<?php echo U('Common/uploadify');?>",
            'fileObjName' : 'img',
            'onUploadSuccess' : function(file, data, response) {
//                console.log('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                var data = eval("("+data+")");
                console.log(data);
                if(data.error==0){
                    var html=
                            ' <dl style="float: left; margin-right:10px; " id="'+file.id +'">'+
                            '<dt style="border: 1px solid #999;padding: 5px;"><img src="/'+data.path+'" width="100" height="100"></dt>'+
                            '<input type="hidden" name="pic[]" value="'+data.path+'">'+
                            '<dd style="text-align: center;">' +
                            '<button onclick="mainpic(this)" style="margin-right: 5px" type="button">主图</button>' +
                            '<button onclick="delpic(this)" type="button">删除</button>'+
                            '</dd>' +
                            '</dl>';
                    $('#queue').append(html);
                }
            }
        });
    });

    function mainpic(obj){
        //先把所有的input里的属性name的值全改成pic
        $(obj).parents('#queue').find('input[type="hidden"]').prop('name','pic[]');
        //当设置主图时，令选中为主图照片的input里的属性name的值改成image
        $(obj).parent('dd').siblings('input[type="hidden"]').prop('name','image');

        //先把所有的边框变成默认的颜色
        $(obj).parents('#queue').find('dt').css({border:'1px solid #999'});
        //当被设置为主图时，令选中为主图照片的边框样式改成红色
        $(obj).parents('dl').find('dt').css({border:'1px solid red'});
    }

    function delpic(obj){
        $(obj).parents('dl').remove();
    }

</script>
<script type="text/javascript">

//搜索
function changesearch(){	
		
}

//单个删除
function del(id,mid,iscid){
	if(confirm("您确定要删除吗?")){
		
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>
</body>
</html>