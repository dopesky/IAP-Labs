<?php
include 'Crud.php';
include 'DBConnector.php';
class User implements Crud{
	private $dbConn;
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;

	public function __construct($first_name,$last_name,$city_name){
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->city_name = $city_name;
		$this->dbConn = new DBConnector();
	}

	public function setUserId($user_id){
		$this->user_id = $user_id;
	}

	public function getUserId(){
		return $this->user_id;
	}

	public function save(){
		$sql = 'INSERT into `user` (`first_name`,`last_name`,`user_city`) VALUES ("'.$this->first_name.'","'.$this->last_name.'","'.$this->city_name.'")';
		$res = mysqli_query($this->dbConn->conn,$sql) or die('ERROR: '.mysqli_error($this->dbConn->conn));
		return $res;
	}

	public function readAll(){
		$sql = "SELECT * from `user`";
		$res = mysqli_query($this->dbConn->conn,$sql);
		return $res->num_rows>0 ? $res:false;
	}
	public function readUnique(){
		return null;
	}
	public function search(){
		return null;
	}
	public function update(){
		return null;
	}
	public function removeOne(){
		return null;
	}
	public function removeAll(){
		return null;
	}
}
?>