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
  <div class="panel-head" id="add"><strong>
    <span class="icon-pencil-square-o"></span>
      <?php if(empty($_GET['id'])): ?>增加<?php else: ?>修改<?php endif; ?>
      内容
    </strong>
  </div>
  <div class="body-content">
    <form method="post" class="form-x" action="">
        <div class="form-group">
            <div class="label">
                <label>商品：</label>
            </div>
            <div class="field">
                <select name="goods_id" class="input w50">
                    <option>所属商品</option>
                     <?php if(is_array($goods)): foreach($goods as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"  <?php if(($v['id']) == $banner['goods_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["goods_name"]); ?></option><?php endforeach; endif; ?>
                  
                </select>
                <div class="tips"></div>
            </div>
        </div>
        

        <div class="form-group">
            <div class="form-group">
            <div class="label">
                <label>图片：</label>
            </div>
            <div class="field">
                <input id="file_upload" name="file_upload" type="file" multiple="true" value="+ 浏览上传">
                <!--<input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;" onclick="uploadpic()">-->
                <div id="queue">
                    <?php if(!empty($_GET['id'])): ?><dl style="float: left; margin-right:10px;" id="">
                        <dt ><img src="/<?php echo ($banner["image"]); ?>" width="100" height="100"></dt>
                        <input type="hidden" name="image" value="<?php echo ($banner["image"]); ?>">
                        <dd style="text-align: center;">
                            <button onclick="delpic(this)" type="button">删除</button>
                            </dd>
                        </dl><?php endif; ?>
                </div>
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
     $(function() {
        $('#file_upload').uploadify({
            'buttonText' : '+ 浏览上传',
            'swf'      : '/Public/Admin/Uploadify/uploadify.swf',
            'buttonClass':'button bg-blue',
            'height':42,
            'width':102,
            'uploader' : "<?php echo U('Common/uploadify');?>",
            'fileObjName' : 'img',
            'multi':false,
            'onUploadSuccess' : function(file, data, response) {
                var data = eval("("+data+")");
                // console.log(data);
                if(data.error==0){
                    var html=
                            ' <dl style="float: left; margin-right:10px; " id="'+file.id +'">'+
                            '<dt ><img src="/'+data.path+'" width="100" height="100"></dt>'+
                            '<input type="hidden" name="image" value="'+data.path+'">'+
                            '<dd style="text-align: center;">' +
                            
                            '<button onclick="delpic(this)" type="button">删除</button>'+
                            '</dd>' +
                            '</dl>';
                    $('#queue').html(html);
                }
            }
        });
    });

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