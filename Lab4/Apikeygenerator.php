<?php
include 'DBConnector.php';
session_start();
if($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['username'])){
	header('HTTP/2.0 403 Forbidden');
	echo("You are Forbidden!");
	return;
}

function generateAPIKey($length){
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
     $codeAlphabet.= "0123456789";
     $max = strlen($codeAlphabet);

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $token;
}

function saveAPIKey($apikey){
	$sql = "SELECT * FROM `user` WHERE `username` = '".strtolower($_SESSION['username'])."'";
	$dbConn = new DBConnector();
	$res = mysqli_query($dbConn->conn, $sql) or die('ERROR: '.mysqli_error($dbConn->conn));

	if($res->num_rows !== 1) return false;
	$row = $res->fetch_assoc();
	$user_id = $row['id'];
	$sql = "SELECT * FROM `api_keys` WHERE `user_id` = '".$user_id."'";
	$res = mysqli_query($dbConn->conn, $sql) or die('ERROR: '.mysqli_error($dbConn->conn));

	if($res->num_rows > 0){
		$sql = "UPDATE `api_keys` SET `api_key` = '".$apikey."' WHERE `user_id` = '".$user_id."'";
		$res = mysqli_query($dbConn->conn, $sql) or die('ERROR: '.mysqli_error($dbConn->conn));
		return $res;
	}
	$sql = "INSERT INTO `api_keys`(`user_id`,`api_key`) VALUES ('".$user_id."','".$apikey."')";
	$res = mysqli_query($dbConn->conn, $sql) or die('ERROR: '.mysqli_error($dbConn->conn));
	return $res;
}

function generateResponse($apikey){
	if(saveAPIKey($apikey)){
		$res = ['success'=>true, 'message'=>$apikey];
	}else{
		$res = ['success'=>false, 'message'=>'Something went wrong! Please regenerate the API key.'];
	}
	return json_encode($res);
}
$apikey = generateAPIKey(random_int(60, 68));
echo generateResponse($apikey);
?>