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
            <span class="icon-pencil-square-o"></span>基本设置
        </strong>
    </div>
    <div class="body-content">
        <form method="post" class="form-x" action="" enctype="multipart/form-data">
            <div class="form-group">
                <div class="label">
                    <label>公司名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="company_name" value="<?php echo ((isset($set["company_name"]) && ($set["company_name"] !== ""))?($set["company_name"]):''); ?>"/>
                    <div class="tips"></div>
                </div>
            </div>
            
           
            <div class="form-group">
                <div class="label">
                    <label>电话：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="tel" value="<?php echo ((isset($set["tel"]) && ($set["tel"] !== ""))?($set["tel"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>传真：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="" value="<?php echo ((isset($set["fax"]) && ($set["fax"] !== ""))?($set["fax"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>邮箱：</label>
                </div>
                <div class="field" >
                    <input type="email" class="input w50" name="email" value="<?php echo ((isset($set["email"]) && ($set["email"] !== ""))?($set["email"]):''); ?>"/>
                </div>
            </div>

             <div class="form-group">
                <div class="label">
                    <label>地址：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="address" value="<?php echo ((isset($set["address"]) && ($set["address"] !== ""))?($set["address"]):''); ?>"/>
                </div>
            </div>

             <div class="form-group">
                <div class="label">
                    <label>网址：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="web" value="<?php echo ((isset($set["web"]) && ($set["web"] !== ""))?($set["web"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>版权：</label>
                </div>
                <div class="field" >
                    <input type="text" class="input w50" name="copyright" value="<?php echo ((isset($set["copyright"]) && ($set["copyright"] !== ""))?($set["copyright"]):''); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>二维码：</label>
                </div>
                <div class="field">
                    <input id="file_upload" name="file_upload" type="file" multiple="true" value="+ 浏览上传">
                    <!--<input type="button" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;" onclick="uploadpic()">-->
                    <div id="queue">
                         <?php if(!empty($set['id'])): ?><dl style="float: left; margin-right:10px;" id="">
                            <dt ><img src="/<?php echo ($set["image"]); ?>" width="100" height="100"></dt>
                            <input type="hidden" name="image" value="<?php echo ($set["image"]); ?>">
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