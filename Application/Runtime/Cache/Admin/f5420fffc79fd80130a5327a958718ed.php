<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sing后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/Public/css/sing/common.css" />
    <link rel="stylesheet" href="/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/dialog/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>
<div id="wrapper">
  <?php
 $navs = D("Menu")->getAdminMenus(); $username = getLoginUsername(); foreach($navs as $k=>$v) { if($v['c'] == 'admin' && $username != 'jason') { unset($navs[$k]); } } $index = 'index'; ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >singcms内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo getLoginRealname()?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getActive($index)); ?>>
        <a href="/admin.php"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): $i = 0; $__LIST__ = $navs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navo): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($navo["c"])); ?>>
        <a href="<?php echo (getAdminMenuUrl($navo)); ?>"><i class="fa fa-fw fa-bar-chart-o"></i> <?php echo ($navo["name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>

    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- Page Heading -->

	<!-- DataTables CSS -->	  
	<link rel="stylesheet" type="text/css" href="Public/js/Datatables/jquery.dataTables.min.css">
	<!-- jQuery -->
	<script type="text/javascript" charset="utf8" src="Public/js/jquery.js"></script>
	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="Public/js/Datatables/jquery.dataTables.min.js"></script>

      <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
            <li>
              <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=enter">入库管理</a>
            </li>
            <li class="active">
              <i class="fa fa-edit"></i>添加新型号
            </li>
          </ol>
        </div>
      </div>
      <div class="row">
		<!--第二步：添加如下 HTML 代码-->
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<!--暂时不用--<th>序号</th>-->
					<th>型号</th>
					<th>入库板数</th>
					<th>入库总数</th>
					<!--暂时不用--<th>箱号</th>-->
					<th>入库日期</th>
					<th>入库时间</th>
					<th>入库担当</th>
					<th>出库担当</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($enterlens)): $i = 0; $__LIST__ = $enterlens;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$enterlens): $mod = ($i % 2 );++$i;?><tr>
						<!--暂时不用--<td><?php echo ($enter["enter_id"]); ?></td>-->
						<td><?php echo ($enterlens["et_model"]); ?></td>
						<td><input type="text" id="enternum" name="enternum"/></td>
						<td><input type="text" id="enternum" name="enternum"/></td>
						<td>时间</td>
						<td>日期</td>
						<td><?php if(is_array($lensColorType)): foreach($lensColorType as $key=>$enteruser): ?><option value="<?php echo ($key); ?>"><?php echo ($enteruser); ?></option><?php endforeach; endif; ?></td>
						<td><?php if(is_array($lensColorType)): foreach($lensColorType as $key=>$mduser): ?><option value="<?php echo ($key); ?>"><?php echo ($mduser); ?></option><?php endforeach; endif; ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" id="singcms-button-submit">提交</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
var SCOPE = {
	'save_url' : '/admin.php?c=enter&a=add',
	'jump_url' : '/admin.php?c=enter',
};
$(document).ready(function() {
	var table = $('#example').DataTable({
		"iDisplayLength":100,
		"oLanguage":{
			"sProcessing":"正在加载中......",
			"sLengthMenu":"每页显示 _MENU_ 条记录",
			"sZeroRecords":"对不起，查询不到相关数据！",
			"sEmptyTable":"表中无数据存在！",
			"sInfo":"当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
			"sInfoFiltered":"数据表中共为 _MAX_ 条记录",
			"sSearch":"搜索",
			"oPaginate":{
				"sFirst":"首页",
				"sPrevious":"上一页",
				"sNext":"下一页",
				"sLast":"末页"
			}
		},
	});
	$('button').click(function() {
		var data = table.$('input, select').serialize();
		alert("The following data would have been submitted to the server: \n\n" + data.substr(0, 120) + '...');
		return false;
	
	});
});
</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>