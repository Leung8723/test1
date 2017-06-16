<?php
//引入配置文件
require dirname(__FILE__)."/dbconfig.php";

	class db{
		public $conn=null;
		
		public function __construct($config){
			//连接数据库
			$this->conn=mysql_connect($config['host'],$config['username'],$config['password']) or die(mysql_error());
			//选择数据库
			mysql_select_db($config['database'],$this->conn) or die(mysql_error());
			//设定mysql编码
			mysql_query("set names ".$config['charset']) or die(mysql_error());
		}
		
		//根据传入sql语句 查询mysql结果集
		public function getResult($sql){
			//查询sql语句
			$resource=mysql_query($sql,$this->conn) or die(mysql_error());
			$res=array();
			while(($row=mysql_fetch_assoc($resource))!=false){
				$res[]=$row;
			}
			return $res;
		}
	}
?>