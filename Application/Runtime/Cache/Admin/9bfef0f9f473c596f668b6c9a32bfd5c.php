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
 <link href="/Public/Admin/tree/css/jquery.treetable.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/tree/css/jquery.treetable.theme.default.css" rel="stylesheet" type="text/css" />
<script src="/Public/Admin/tree/jquery.treetable.js"></script>
<form method="get" action="<?php echo U('index');?>" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="<?php echo U('add');?>"> 添加内容</a> </li>
        <li>搜索：</li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" value="<?php echo ($_GET['keywords']); ?>" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="csearch()" > 搜索</a></li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th  style="text-align:left; padding-left:20px;">ID</th>
        <!-- <th>图片</th> -->
        <th>名称</th>
        <th >操作</th>
      </tr>

        <?php if(is_array($cate)): foreach($cate as $key=>$value): ?><tr data-tt-id="<?php echo ($value["id"]); ?>" data-tt-parent-id="<?php echo ($value["pid"]); ?>">
          <td style="text-align:left; padding-left:20px;">
           <?php echo ($value["id"]); ?></td>
         <!--  <td><input type="text" name="sort[1]" value="1" style="width:50px; text-align:center; border:1px solid #ddd; padding:7px 0;" /></td> -->
         <!--  <td width="10%"><img src="images/11.jpg" alt="" width="70" height="50" /></td> -->
          <td><?php echo ($value["cate_name"]); ?></td>
         
          <td>
          <div class="button-group"> 
            <a class="button border-main" href="<?php echo U('edit',['id'=>$value['id']]);?>"><span class="icon-edit"></span> 修改</a> 
            <a class="button border-red" href="javascript:void(0)" onclick="return catedel(<?php echo ($value['id']); ?>)"><span class="icon-trash-o"></span> 删除</a> 
          </div>
          </td>
        </tr><?php endforeach; endif; ?>


      <tr>
        <td colspan="8"><div class="pagelist"> <?php echo ($page); ?></div></td>
      </tr>
    </table>
  </div>
</form>

<script type="text/javascript">
  $(".table").treetable({ expandable: true });

  function csearch(){
   
    $('form').submit();
  }

  function catedel(id) {

    if(confirm('确认删除？')){
        url="<?php echo U('delete',['id'=>'idstr']);?>".replace('idstr',id);
       
        window.location.href=url;
       
      }
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