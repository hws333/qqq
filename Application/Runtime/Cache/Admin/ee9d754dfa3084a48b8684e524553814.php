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
 <style>
    .spec_list .tab{
        height:30px;
        line-height: 30px;
        border-bottom: 1px solid #ccc;
        padding:0;
    }
    .spec_list .tab li{
        float: left;
        padding:0 15px;
        font-size: 14px;
        cursor: pointer;
        }
    .spec_list .tab li.cur{
        background-color: #ccc;
    }
    .spec_list .body {
        padding:10px;
        display: none;
    }
    .spec_list .body .cur {
        display: block;
    }
    .spec_list .body dl{
        clear:both;
    }
    .spec_list .body dt,.spec_list .body dd{
        float: left;
    }
    .spec_list .body dt{
        margin-right: 10px;
    }
    .spec_list .body dd{
        padding:0 10px;
        border:1px solid #ccc;
        margin-right: 10px;
        cursor: pointer;
    }
    .spec_list .body dd.cur{
        background: #01a1ff;
        border: 1px solid #01a1ff;
        color: white;
    }
</style>

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
                                    <?php if(is_array($v['spec_item'])): foreach($v['spec_item'] as $key=>$item): ?><dd class="active" data-item-id="<?php echo ($item["id"]); ?>" data-item-spec_id="<?php echo ($item["spec_id"]); ?>"><?php echo ($item["item"]); ?></dd><?php endforeach; endif; ?>
                                    <p style="clear: both;"></p>
                                </dl><?php endforeach; endif; ?>
                            </div><?php endforeach; endif; ?>
                    </div>

                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="saveitem()">Save changes</button>
        </div>
    </div>


<!--<div class="spec_list">-->
    <!--<ul class="tab">-->
        <!--<?php if(is_array($goods_type)): foreach($goods_type as $key=>$value): ?>-->
            <!--<li <?php if(($key) == "0"): ?>class="cur"<?php endif; ?>><?php echo ($value["type_name"]); ?></li>-->
        <!--<?php endforeach; endif; ?>-->
    <!--</ul>-->
    <!--<div class="tab-body">-->
        <!--<?php if(is_array($goods_type)): foreach($goods_type as $k=>$value): ?>-->
            <!--<div class="body <?php if(($key) == "0"): ?>cur<?php endif; ?>">-->
            <!--<?php if(is_array($value['spec'])): foreach($value['spec'] as $k=>$v): ?>-->
                <!--<dl>-->
                    <!--<dt><?php echo ($v["spec_name"]); ?></dt>-->
                    <!--<?php if(is_array($v['spec_item'])): foreach($v['spec_item'] as $key=>$item): ?>-->
                    <!--<dd data-item-id="<?php echo ($item["id"]); ?>" data-item-spec_id="<?php echo ($item["spec_id"]); ?>"><?php echo ($item["item"]); ?></dd>-->
                    <!--<?php endforeach; endif; ?>-->
                    <!--<p style="clear: both;"></p>-->
                <!--</dl>-->
            <!--<?php endforeach; endif; ?>-->
            <!--</div>-->
        <!--<?php endforeach; endif; ?>-->

        <!--<button type="button" onclick="saveitem()">添加规格</button>-->
        <!--<button type="button" onclick="clo()">取消</button>-->
    <!--</div>-->

<!--</div>-->
<script type="text/javascript">
    $('#myModal').modal('toggle');
    function saveitem(){
        var item_id=[];
        var spec_id=[];
        $('.spec_list dd.cur').each(function () {
            item_id.push($(this).attr('data-item-id'));
            spec_id.push($(this).attr('data-item-spec_id'));
        })
//
//        console.log(item_id);
//        console.log(spec_id);

        $.ajax({
            type:'post',
            url:'<?php echo U("Goods/handel_group");?>',
            data:{id:item_id,spec_id:spec_id},
            dataType:'json',
            success:function(data){
                console.log(data);
            },
            error:function(e){

            }
        })

    }
//    function clo(){
//        layer.closeAll();
//    }
    $('.spec_list .tab li').click(function(){
        $(this).parent().find('li').removeClass('cur');
        $(this).addClass('cur');

        //找到li所在的位置/索引
        var index = $('.spec_list .tab li').index(this);
         $('.spec_list .tab-body .body').css({display:'none'});
         $('.spec_list .tab-body .body').eq(index).css({display:'block'});
    });

    $('dd').click(function(){
        $(this).parents('.body').siblings().find('dd').removeClass('cur');
        $(this).toggleClass('cur');
    })
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