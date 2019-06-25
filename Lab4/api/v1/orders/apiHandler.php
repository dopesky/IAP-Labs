<?php
class ApiHandler{
	private $meal_name;
	private $meal_units;
	private $unit_price;
	private $status;
	private $user_api_key;
	private $user_id;
	private $dbConn;

	public function __construct($user_id, $meal_name, $meal_units, $unit_price, $status, $user_api_key){
		$this->user_id = $user_id;
		$this->meal_name = $meal_name;
		$this->meal_units = $meal_units;
		$this->unit_price = $unit_price;
		$this->status = $status;
		$this->user_api_key = $user_api_key;
		$this->dbConn = new DBConnector;
	}

	public function setMealName($value){
		$this->meal_name = $value;
	}
	public function getMealName(){
		return $this->meal_name;
	}

	public function setMealUnits($value){
		$this->meal_units = $value;
	}
	public function getMealUnits(){
		return $this->meal_units;
	}

	public function setUnitPrice($value){
		$this->unit_price = $value;
	}
	public function getUnitPrice(){
		return $this->unit_price;
	}

	public function setStatus($value){
		$this->status = $value;
	}
	public function getStatus(){
		return $this->status;
	}

	public function setUserApiKey($value){
		$this->user_api_key = $value;
	}
	public function getUserApiKey(){
		return $this->user_api_key;
	}

	public function createOrder(){
		$sql = "INSERT INTO orders(user_id, order_name, units, unit_price, order_status) values ('$this->user_id', '$this->meal_name', '$this->meal_units', '$this->unit_price', '$this->status')";
		$res = mysqli_query($this->dbConn->conn, $sql) or die("Error: ".mysqli_error($this->dbConn->conn));
		return $res;
	}

	public function checkOrderStatus($order_id){
		$sql = "SELECT * from orders where order_id = '$order_id'";
		$res = mysqli_query($this->dbConn->conn, $sql) or die("Error: ".mysqli_error($this->dbConn->conn));
		if($res->num_rows < 1) return 'Invalid Order ID!';
		return ucwords(strtolower($res->fetch_assoc()['order_status']));
	}

	public function fetchAllOrders(){

	}

	public function checkApiKey(){
		$sql = "SELECT api_key from api_keys where user_id = '$this->user_id'";
		$res = mysqli_query($this->dbConn->conn, $sql) or die("Error: ".mysqli_error($this->dbConn->conn));
		if($res->num_rows < 1) return false;
		return $res->fetch_assoc()['api_key'] === $this->user_api_key;
	}

	public function checkContentType(){

	}
}
?>