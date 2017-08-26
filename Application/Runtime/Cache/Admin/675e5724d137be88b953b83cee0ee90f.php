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
    <div class="container-fluid" >
	
	<!-- DataTables CSS -->	  
	<link rel="stylesheet" type="text/css" href="Public/js/Datatables/jquery.dataTables.min.css">
	<!-- jQuery -->
	<script type="text/javascript" charset="utf8" src="Public/js/jquery.js"></script>
	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="Public/js/Datatables/jquery.dataTables.min.js"></script>

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
            <li>
              <i class="fa fa-dashboard"></i><a href="/admin.php?c=enter">入库管理</a>
            </li>
            <li class="active">
              <i class="fa fa-table"></i>当日入库明细
            </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      <div>
        <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>产品入库</button>
      </div>
      </br>
		<table id="table_id_example" class="display">
			<thead>
			<tr>
			  <!--暂时不用--<th>序号</th>-->
			  <th>型号</th>
			  <th>入库数量</th>
			  <th>入库日期</th>
			  <th>入库时间</th>
			  <!--暂时不用--<th>成型箱号</th>-->
			  <th>入库担当</th>
			  <th>成型担当</th>
			  <th>提交时间</th>
			  <th>更新时间</th>
			  <th>编辑</th>
			</tr>
			</thead>
				<tbody>
					<?php if(is_array($enters)): $i = 0; $__LIST__ = $enters;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$enter): $mod = ($i % 2 );++$i;?><tr>
						<!--暂时不用--<td><?php echo ($enter["enter_id"]); ?></td>-->
						<td><?php echo ($enter["et_model"]); ?></td>
						<td><?php echo ($enter["et_num"]); ?></td>
						<td><?php echo ($enter["et_date"]); ?></td>
						<td><?php echo (date("H:i:s",$enter["et_time"])); ?></td>
						<!--暂时不用--<td><?php echo ($enter["et_box"]); ?></td>-->
						<td><?php echo ($enter["create_user"]); ?></td>
						<td><?php echo ($enter["md_user"]); ?></td>
						<td><?php echo (date("H:i:s",$enter["create_time"])); ?></td>
						<td><?php echo ($enter["update_time"]); ?></td>
						<td><span class="sing_cursor glyphicon glyphicon-edit" aria-hidden="true" id="singcms-edit" attr-id="<?php echo ($enter["news_id"]); ?>" ></span>
						  <a href="javascript:void(0)" id="singcms-delete"  attr-id="<?php echo ($enter["news_id"]); ?>"  attr-message="删除">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
						  </a>
						</td>
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
		</table>
    </div>
   </div>
</div>
<script>
var SCOPE = {
'add_url' : '/admin.php?c=enter&a=add',
}
//初始化DataTables
$(document).ready( function () {
	$('#table_id_example').DataTable({
		"iDisplayLength":100,
		"aaSorting":[[2,'desc'],[3,'desc'],[0,'asc']],
		//"bSort":false,//排序开关
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
		}
	});
});
</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>