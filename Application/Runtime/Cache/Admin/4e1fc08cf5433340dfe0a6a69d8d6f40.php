<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
 <link href="static/admin/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="static/admin/css/jquery.min.js"></script>
<script type="tsext/javascript" src="static/admin/css/bootstrap.min.js"></script>
<body>
	  <div class="panel-heading clearfix">品牌名称修改
		<a href="#" class="btn btn-default pull-right"><span class="glyphicon glyphicon-th-list"> 品牌名称列表</span></a>
	  </div>
	  <div class="panel-body">
		<form class="form-horizontal" action="" method="post">
		  <div class="form-group">
		    <label for="inputCatename" class="col-sm-2 control-label">品牌名称</label>
		    <div class="col-sm-10">
		      <input type="text" name="brand_name" class="form-control" id="inputCatename" placeholder="品牌名称" value="<?php echo ($info["brand_name"]); ?>">
		    </div>
		  </div>
		  
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">提交</button>
		    </div>
		  </div>
		</form>
	</div>

</body>
</html>