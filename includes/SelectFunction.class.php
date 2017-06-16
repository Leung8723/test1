<?php
require_once "MySQLi_BAE.class.php";
$nowtime=date("Y-m-d H:i:s",time()+6*60*60);
class selectData
{
	public function __construct(){
		$this->mysqli_BAE=new MySQLi_BAE();
	}
	//实时汇总
	public function selectNow(){
		$search_users_sql="";
		$res=$this->mysqli_BAE->execute_dql($sql);
		$rows=$res->fetch_array(MYSQLI_ASSOC);
	}
	//实时镀膜
	public function selectCoating(){
		$sql="SELECT * FROM sk_coating";
		$res=$this->mysqli_BAE->execute_dql($sql);
		$rows=$res->fetch_array(MYSQLI_ASSOC);
		return $rows;
	}
	//按型号查询
	public function selectModel(){
		$search_users_sql="";
		$res=$this->mysqli_BAE->execute_dql($sql);
		$rows=$res->fetch_array(MYSQLI_ASSOC);
	}
}
?>