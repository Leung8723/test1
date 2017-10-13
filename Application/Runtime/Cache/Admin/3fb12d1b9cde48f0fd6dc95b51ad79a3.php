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
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="Public/css/layui/css/layui.css" media="all">
        <link rel="stylesheet" type="text/css" href="Public/js/Datatables/jquery.dataTables.min.css">
		<!-- jQuery -->
		<script type="text/javascript" charset="utf8" src="Public/js/jquery.js"></script>
		<script type="text/javascript" charset="utf8" src="Public/css/layui/layui.js"></script>
		<script type="text/javascript" charset="utf8" src="Public/js/dialog/layer.js"></script>
		<script type="text/javascript" charset="utf8" src="Public/js/Datatables/jquery.dataTables.min.js"></script>
        <!-- Page Heading --></br>
        </br>
        </br>
        </br>
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li>
                <i class="fa fa-dashboard"></i>
                <a href="/admin.php?c=coating">镀膜管理</a></li>
              <li class="active">
                <i class="fa fa-edit"></i>产品镀膜</li>
            </ol>
          </div>
        </div>
        <!-- /.row -->
		<script>
		var myDate = new date();
		var myHour = myDate.getHours();
		</script>
        <form class="layui-form" method="post" action="">
          <!-- -->
          <div class="layui-form-item">
            <tr>
              <div class="layui-row">
                <td>
                  <div class="layui-col-md3">
                    <label class="layui-form-label">日期</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="coatingdate" id="coatingdate" type="text" placeholder="yyyy-MM-dd"></div>
                  </div>
                </td>
                <td>
                  <div class="layui-col-md3">
                    <label class="layui-form-label">时间</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="coatingtime" id="coatingtime" type="text" placeholder="hh:mm:ss"></div>
                  </div>
                  </br>
                </td>
                <td>
                  <div class="layui-col-md3"></div>
                </td>
              </div>
            </tr>
            <tr>
              <div class="layui-row">
                <td>
                  <div class="layui-col-md3">
                    <label class="layui-form-label">设备</label>
                    <div class="layui-input-inline">
                      <select name="machine" id="machine" lay-verify="required" lay-search="">
                        <option value="">==请选择镀膜设备==</option>
                        <?php if(is_array($machine)): foreach($machine as $key=>$machine): ?><option value="<?php echo ($machine["name"]); ?>"><?php echo ($machine["name"]); ?>号机</option><?php endforeach; endif; ?>
                      </select>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="layui-col-md3">
                    <label class="layui-form-label">批次</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" name="lotnum" id="lotnum" required type="text" lay-verify="text" placeholder="输入设备代码+LOT号码!"></div>
                  </div>
                </td>
                <td>
                  <div class="layui-col-md3">
                    <label for="inputId" class="layui-form-label">担当</label>
                    <div class="layui-input-inline">
                      <select name="ctuser" lay-verify="required" lay-search="">
                        <option value="">==请选择设备担当==</option>
                        <?php if(is_array($ctuser)): foreach($ctuser as $key=>$ctuser): ?><option value="<?php echo ($ctuser["ct_name"]); ?>"><?php echo ($ctuser["ct_name"]); ?></option><?php endforeach; endif; ?>
                      </select>
                    </div>
                  </div>
                </td>
            </tr>
            <?php foreach ($lensnum as $key=>$value){ ?>
              <tr>
                <div class="layui-row">
                  <td>
                    <div class="layui-col-md3">
                      <label for="inputId" class="layui-form-label">型号</label>
                      <div class="layui-input-inline">
                        <input name="<?php echo "model".$key?>" value="<?php echo $value[et_model]?>" required lay-verify="text" autocomplete="off" class="layui-input" type="text" readonly="readonly"></div>
                    </div>
                  </td>
                  <td>
                    <div class="layui-col-md3">
                      <label class="layui-form-label">数量</label>
                      <div class="layui-input-inline">
                        <input name="<?php echo "ctnum".$key ?>" value="<?php echo $value[etnum]?>" lay-verify="number" autocomplete="on" class="layui-input" type="text"></div>
                    </div>
                  </td>
                  <td>
                    <div class="layui-col-md6">
                      <label class="layui-form-label">备注</label>
                      <div class="layui-input-inline">
                        <input name="<?php echo "tips".$key ?>" lay-verify="text" autocomplete="off" class="layui-input" type="text"></div>
                    </div>
                  </td>
                </div>
              </tr>
              <?php }?>
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button></div>
                </div>
        </form>
        </div>
      </div>
    </div>
  </div>

<script>
var SCOPE = {
  'jump_url': '/admin.php?c=coating',
}

//lay-form
layui.use(['form','layer'],function() {
  var form = layui.form;
  var url = SCOPE.jump_url;
//监听提交
  form.on('submit(formDemo)',function(data){
	$.post("admin.php?c=coating&a=add",data.field,function(result){;
		if(result.status == 1){
			layer.msg(result.message, {icon: 2,time: 3000});
			self.location.reload();
		}else if(result.status == 0){
			layer.msg(result.message, {icon: 1,time: 3000});
			window.location.href=url;
		}
	},"JSON");
	return false;
  });
});

//laydate
layui.use('laydate',function() {
  var laydate = layui.laydate;
	//date
	laydate.render({
	  elem: '#coatingdate' //指定元素
	  ,type: 'date'
	  ,value: new Date()
	  ,theme: 'molv'
	});
	//time
	laydate.render({
	  elem: '#coatingtime'
	  ,type: 'time'
	  ,value: new Date()
	  ,theme: 'molv'
	  });
});

  //格式化时间
function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}
var myDate = new Date();
var result = checkTime(myDate.getHours()) + ':' + checkTime(myDate.getMinutes()) + ':' + checkTime(myDate.getSeconds());
var result2 = myDate.getFullYear() + '-' + checkTime(myDate.getMonth()+1) + '-' + checkTime(myDate.getDate());
document.getElementById("coatingtime").value = result;
document.getElementById("coatingdate").value = result2;
</script>
<script src="/Public/js/admin/common.js"></script>
</body>
</html>