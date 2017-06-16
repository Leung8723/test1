<?php
require_once "MySQLi_BAE.class.php";
$nowtime=date("Y-m-d H:i:s",time()+6*60*60);
class insertData
{
	public function __construct(){
		$this->mysqli_BAE=new MySQLi_BAE();
	}
	//型号添加
	public function insertModel($lensname,$colordata,$materialdata){
		global $nowtime;
		$typename=strtoupper(substr($lensname,0,6));
		$lens=strtoupper(substr($lensname,6,2));
		$times=substr($lensname,strpos($lensname,"L")+3,strlen($lensname)-strpos($lensname,"L")+1);
		$colorUp=strtoupper($colordata);
		$materialUp=strtoupper($materialdata);
		$sql="INSERT INTO `sekonix`.`sk_lens`(id, model, name, lens, times, color, material, updatatime)VALUES(NULL ,'$lensname','$typename','$lens','$times','$colorUp','$materialUp','$nowtime')";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}
	//担当人员添加
	public function addPerson($name,$type){
		$array=array(
			'1'=>'sk_ctuser',//镀膜担当
			'2'=>'sk_ckuser',//单品担当
			'3'=>'sk_mduser'//成型担当
		);
		global $nowtime;
		$sql="INSERT INTO `sekonix`.$array[$type]( name ,create_time)VALUES('$name','$nowtime')";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}
	//前后台用户添加
	public function addUser($name,$realname,$passwd,$type){
		global $nowtime;
		$sql="INSERT INTO `sekonix`.`sk_user`( user_name ,real_name ,password ,type ,create_time)VALUES('$name','$realname','$passwd','$type','$nowtime')";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}
	//添加镀膜机
	public function addMachine($name,$nick){
		global $nowtime;
		$sql="INSERT INTO `sekonix`.`sk_machine`( name ,nickname ,create_time)VALUES('$name','$nick','$nowtime')";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}	
	//添加色相种类
	public function addColor($color,$user){
		global $nowtime;
		$sql="INSERT INTO `sekonix`.`sk_color`( color_type ,create_user ,create_time)VALUES('$color','$user','$nowtime')";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}
	//产品入库
	public function enterLens($model,$date,$time,$num,$box,$euser,$muser){
		global $nowtime;
		$sql="INSERT INTO `sekonix`.`sk_enter` VALUES(NULL,'$model','$date','$time','$num','$box','$euser','$muser','$nowtime',NULL)";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}
	//产品入库
	public function coatingLens($model,$machine,$date,$lot,$ctuser,$start,$over,$num,$create){
		global $nowtime;
		$sql="INSERT INTO `sekonix`.`sk_coating` VALUES(NULL,'$model','$machine','$date','$lot','ctuser','$start','$over','$num','$create','$nowtime',NULL,NULL)";
		$res=$this->mysqli_BAE->execute_dml($sql);
	}
	
	
	
}

?>