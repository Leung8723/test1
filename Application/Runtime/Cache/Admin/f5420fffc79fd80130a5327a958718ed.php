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
<table id="table_id_example" class="display">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
		<?php if(is_array($enters)): $i = 0; $__LIST__ = $enters;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$enter): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($enter["et_model"]); ?></td>
            <td><?php echo ($enter["et_num"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>
 
 
 
<!--第三步：初始化Datatables-->

<?php
 ?>
			
			<!--
              <table class="table table-bordered table-hover singcms-table">
                <thead>
                <tr>
				  <th>
					<div class="col-lg-6">
					  <form class="form-horizontal" id="singcms-form">
						  <label for="inputname" class="col-sm-2 control-label">入库日期:</label>
						  <div class="col-sm-5">
							<select class="form-control" name="color">
							  <option value="">==请选择日期==</option>
								<?php if(is_array($lensColorType)): foreach($lensColorType as $key=>$color): ?><option value="<?php echo ($key); ?>"><?php echo ($color); ?></option><?php endforeach; endif; ?>
							</select>
						  </div>
						</div>	
				  </th>
                  <!--<th>型号</th>
				  <th>入库数量</th>--
				  <th>
					<div class="form-group">
					  <label for="inputname" class="col-sm-2 control-label">成型担当:</label>
					  <div class="col-sm-5">
						<select class="form-control" name="material">
							<option value="">==请选择出库担当==</option>
								<?php if(is_array($lensMaterialType)): foreach($lensMaterialType as $key=>$material): ?><option value="<?php echo ($key); ?>"><?php echo ($material); ?></option><?php endforeach; endif; ?>
						</select>
					  </div>
					</div>				  
				  </th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
						<div class="col-sm-5">
							<input type="text" name="model" class="form-control" id="inputname" placeholder="请填写型号全称">
							<input type="text" name="model" class="form-control" id="inputname" placeholder="请填写型号全称">
							<input type="text" name="model" class="form-control" id="inputname" placeholder="请填写型号全称">
							<input type="text" name="model" class="form-control" id="inputname" placeholder="请填写型号全称">
						</div>
					</td>
                    <td>
						<div class="col-sm-5">
							<input type="text" name="enternum" class="form-control" id="inputname" placeholder="请填写入库数量">
							<input type="text" name="enternum" class="form-control" id="inputname" placeholder="请填写入库数量">
							<input type="text" name="enternum" class="form-control" id="inputname" placeholder="请填写入库数量">
							<input type="text" name="enternum" class="form-control" id="inputname" placeholder="请填写入库数量">
						</div>
					</td>

                  </tr>
                </tbody>
              </table>			
			-->
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
    'jump_url' : '/admin.php?c=enter&a=add',
  };
</script>
<script>
	$(document).ready( function () {
		$('#table_id_example').DataTable();
	} );
</script>
<script src="/Public/js/admin/common.js"></script>



</body>

</html>