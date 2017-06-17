<?php
require_once "/includes/MMysql.class.php";
require_once "/includes/configure.php";
$mysql = new MMysql($conf);
/*
//插入
$data = array(
    'id'=>NULL,
    'ct_model'=>1,
    'ct_machine'=>5,
	'ct_date'=>'2017-06-17',
	'ct_lot'=>'1',
	'ct_user'=>'1',
	'start_time'=>'8:45:00',
	'over_time'=>NULL,
	'ct_num'=>1680,
	'create_user'=>1,
	'create_time'=>'2017-06-17 8:46:45',
	'update_time'=>NULL,
	'tips'=>NULL
    );
$mysql->insert('sk_coating',$data);*/

//查询
$res = $mysql->field('id,ct_model,ct_num')
    ->order('id asc,ct_model asc')
    ->where('id=1 or ct_model<123455')
    ->limit(1,50)
    ->select('sk_coating');
var_dump($res);