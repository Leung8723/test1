<?php
require_once "/includes/InsertFunction.class.php";
$insertObj=new insertData();
/**
 * 产品镀膜
 * 型号代码/设备代码/批次/日期/镀膜担当/开始时间/结束时间/数量/入库担当
 **参数:$model,$machine,$lot,$date,$ctuser,$start,$over,$num,$create**/
//$insertObj->coatingLens("1","5","2017-6-15","1","1","15:30","17:00","2240","1");

/**
 * 产品入库
 * 型号代码/日期/时间/数量/箱号/入库担当/成型担当
 **参数:$model,$date,$time,$num,$box,$euser,$muser**/
//$insertObj->enterLens("1","2016-6-15","17:00","2240","15","1","1");

/**
 * 镀膜机添加
 * 设备名/英文代号(一个字母)
 **参数:$name,$nick**/
//$insertObj->addMachine("13号机","M");

/**
 * 用户添加
 * 用户名/姓名/密码/权限(1超级管理,2后台用户,3前台访客)
 **参数:$name,$realname,$passwd,$type**/
//$insertObj->addUser("jason","梁国成","admin","1");

/**
 * 型号添加
 * 型号/色相/材质
 **参数:$lensname,$colordata,$materialdata**/
//$insertObj->insertModel("Mv1419L2-13","Green","E48r");

/**
 * 人员添加
 * 姓名/部署(1镀膜担当/2单品担当/3成型担当)
 **参数:$name,$type**/
//$insertObj->addPerson("马士友",2);

/**
 * 色相种类添加
 * 颜色/操作者
 **参数:$color,$user**/
//$insertObj->addColor("GREEN#1",1);
?>