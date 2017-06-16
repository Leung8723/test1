<?php
/**
 * Date:2017-06-14
 */

require_once 'configure.php';

class MySQLi_BAE{
	private $mysqli;
	private $host;
	private $user;
	private $password;
	private $port;
	private $database;
	//在类之外访问私有变量时使用
	function __get($property_name){
		if(isset($this->$property_name)){
			return($this->$property_name);
		}else{
			return(NULL);
		}    
	}

	function __set($property_name, $value){
		$this->$property_name=$value;
	}

	function __construct(){
		/*从平台获取查询要连接的数据库名称*/
		$this->database = MYSQLNAME;
		/*从环境变量里取出数据库连接需要的参数*/
		$this->host = getenv('127.0.0.1');
		$this->user = getenv('root');
		$this->password = getenv('jason19870723');
		$this->port = getenv('3306');
		$this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
		if($this->mysqli->connect_error){
			die("Connect Server Failed:".$this->mysqli->error);
		}	
		$this->mysqli->query("set names utf8");
	}
	//dql statement
	function execute_dql($query){
		$res = $this->mysqli->query($query) or die("操作失败".$this->mysqli->error);
		return $res;
	}
	//dml statement
	function execute_dml($query){
		$res = $this->mysqli->query($query) or die("操作失败".$this->mysqli->error);
		if(!$res){
			return 0;//失败
		}else{
			if($this->mysqli->affected_rows > 0){
				return 1;//执行成功
			}else{
				return 2;//没有行受影响
			}
		}
	}
}
?>