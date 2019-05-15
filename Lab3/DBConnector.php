<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS', 'biggie5941');
define('DB_NAME', 'btc3205');

class DBConnector{
	public $conn;

	public function __construct(){
		$this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME) or die("ERROR: ".mysqli_connect_error());
	}

	public function close_to_database($credentials){
		mysqli_close($this->conn);
	}
}
?>