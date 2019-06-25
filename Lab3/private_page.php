<?php
session_start();
include 'User.php';
if(empty($_SESSION) || !array_key_exists('username', $_SESSION)){
	echo "<script>location.replace('login.php')</script>";
	return;
}
if(isset($_POST['logout'])){
	$user = User::null_constructor();
	$user->logout();
	header('Refresh:0');
	return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IAP Lab 3</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: whitesmoke;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	span{
		float: right;
		color: #17a2b8;
		cursor: pointer;
		font-size: 18px;
		font-family: monospace;
	}
	span:hover{
		color: #138496;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to Our Site <?=$_SESSION['username']?>!<span onclick="document.getElementsByTagName('form')[0].submit()">Logout</span></h1>

	<div id="body">
		<p>The page you are looking at has being generated for logged in users.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>private_page.php</code>

		<p>The corresponding logic is found at:</p>
		<code>Users.php</code>

		<p>If you are looking to learn Codeigniter Framework, where the original format of this page was extracted, you should start by reading the <a href="https://codeigniter.com/user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Created by 101538, BICS Year 3 Semester 1 Group B, IAP Lab 3</p>
</div>
<form method="post">
	<input type="hidden" name="logout">
</form>
</body>
</html>