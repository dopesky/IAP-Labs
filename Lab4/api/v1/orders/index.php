<?php
include_once 'apiHandler.php';
include_once '../../../User.php';
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		$api_key = $_SERVER['HTTP_APIKEY'];
		$name = $_POST['name_of_food'];
		$units = $_POST['number_of_units'];
		$price = $_POST['unit_price'];
		$status = $_POST['status'];
		$username = $_POST['username'];
		$user = User::null_constructor();
		$user->setUsername($username);
		$user_id = $user->getUserId();
		$apiHandler = new ApiHandler($user_id, $name, $units, $price, $status, $api_key);
		if($apiHandler->checkApiKey()){
			if($apiHandler->createOrder()){
				$response = array('success' => 1, 'message' => 'Order has Been Placed!');
				header("HTTP/1.1 202");
			}else{
				$response = array('success' => 0, 'message' => 'Order has NOT Been Placed! Something Bad Happened!');
				header("HTTP/1.1 500");
			}
		}else{
			$response = array('success' => 0, 'message' => 'Invalid API KEY!');
			header("HTTP/1.1 403");
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
	case 'GET':
		$api_key = $_SERVER['HTTP_APIKEY'];
		$username = $_GET['username'];
		$order_id = $_GET['order_id'];
		$user = User::null_constructor();
		$user->setUsername($username);
		$user_id = $user->getUserId();
		$apiHandler = new ApiHandler($user_id, '', '', '', '', $api_key);
		if($apiHandler->checkApiKey()){
			$response = array('success' => 1, 'message' => $apiHandler->checkOrderStatus($order_id));
			header("HTTP/1.1 202");
		}else{
			$response = array('success' => 0, 'message' => 'Invalid API KEY!');
			header("HTTP/1.1 403");
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		break;
	default:
		$response = array('success' => 0, 'message' => 'Invalid Request Method! Not Yet Supported!');
		echo json_encode($response);
		break;
}
?>