<?php
session_start();
include 'User.php';
$user = User::null_constructor();
if(empty($_SESSION) || !array_key_exists('username', $_SESSION)){
	echo "<script>location.replace('login.php')</script>";
	return;
}
if(isset($_POST['logout'])){
	$user->logout();
	header('Refresh:0');
	return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IAP Lab 4</title>

	<!--Load dependencies from CDNs. These are only for the purpose of front-end design (bootstrap) and validation (JQuery).-->
	<link rel="shortcut icon" type="image/png" href="https://res.cloudinary.com/dkgtd3pil/image/upload/v1554896611/other_data/pngtree_color_internet_programming_icon_internet_png_image_621325_icon.png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/kt-2.5.0/r-2.2.2/datatables.min.css"/>
	<style type="text/css">
		.close,button{
			outline: none !important;
			box-shadow: none !important;
		}
		img{
			width: 100%;
			height: 315px;
		}
	</style>

	<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/kt-2.5.0/r-2.2.2/datatables.min.js"></script>
	<!--End of Dependencies. Comment out the above lines to remove any styling and front-end validation used.-->

	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="validate.js"></script>
	<script src="apikey.js"></script>
</head>
<body>

<div id="container">
	<h1><b>Welcome to Our Site <?=$_SESSION['username']?>!</b><span onclick="document.getElementsByTagName('form')[0].submit()">Logout</span></h1>

	<h6 class="ml-3"><b>Here we will create an API that will allow Users/Developer to order items from external system.</b></h6>
	<p class="ml-4"><b>Now we add the functionality of allowing users to generate API keys. Click on the button to generate an API Key.</b></p>

	<div id="body">
		<button class="btn btn-primary font-sm mb-3 ml-2" id="api-key-button" onclick="getAPIKey()">Generate API Key</button><br>

		<strong class="ml-2">Your API Key: </strong>(Note that if your API Key is already in use in another running application, generating a new one will stop that application from functioning.)<br>
		<textarea id="api_key" class="form-control mb-3 mt-3 font-sm" name="api_key" readonly><?= $user->fetchUserAPIKey()?></textarea>
		<h6><b>Service Description</b></h6>
		<p class="ml-2">We have a service/application that allows external applications to order food and also pull all order status by using order ID. Let's Do it!</p>
		<h6><b>Miscellaneous</b></h6>
		<div class="ml-2">
			<p>The page you are looking at has being generated for logged in users.</p>

			<p> If you would like to edit this page you'll find it located at:</p>
			<code>private_page.php</code>

			<p>The corresponding logic is found at:</p>
			<code>Users.php</code>

			<p>If you are looking to learn Codeigniter Framework, where the original format of this page was extracted, you should start by reading the <a href="https://codeigniter.com/user_guide/">User Guide</a>.</p>
		</div>
	</div>

	<p class="footer">Created by 101538, BICS Year 3 Semester 1 Group B, IAP Lab 4</p>
</div>
<form method="post">
	<input type="hidden" name="logout">
</form>
</body>
</html>