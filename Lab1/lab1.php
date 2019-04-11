<?php
//Function to do backend validation
function validate($data){
	foreach($data as $single){
		if(strlen(trim($single))<1){
			return array('ok'=>false,'msg'=>'<div class="toast" data-delay="3000"><div class="toast-body bg-danger text-light"><strong>Error: </strong>Ensure You Have Filled all Fields!</div></div>');
		}
		if(preg_match('/[^a-z0-9 \'-]/i',$single)){
			return array('ok'=>false,'msg'=>'<div class="toast" data-delay="3000"><div class="toast-body bg-danger text-light"><strong>Error: </strong>Only Alphanumeric Characters are Required!</div></div>');
		}
	}
	return array('ok'=>true);
}
session_start();
include 'User.php';
$user=null;
if(isset($_POST['btn-save'])){
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city = $_POST['city_name'];

	//Do Back End Validation for double protection incase front-end validation fails. 
	$validation_response = validate(array($first_name,$last_name,$city));
	if(!$validation_response['ok']){
		$_SESSION['info'] = $validation_response['msg'];
		echo "<script>location.replace('lab1.php')</script>";
		return;
	}

	$user = new User($first_name,$last_name,$city);
	$res = $user->save();
	if($res){
		$_SESSION['info'] = '<div class="toast" data-delay="3000"><div class="toast-body bg-success text-light"><strong>Success: </strong>Save Operation was Successful!</div></div>';
	}else{
		$_SESSION['info'] = '<div class="toast" data-delay="3000"><div class="toast-body bg-danger text-light"><strong>Error: </strong>An Error Occurred</div></div>';
	}
	echo "<script>location.replace('lab1.php')</script>";
	return;
}
$user = ($user===null) ? new User('','','') : $user;
$data = $user->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>IAP Lab 1</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--Load dependencies from CDNs. These are only for the purpose of front-end design (bootstrap) and validation (JQuery).-->
	<link rel="shortcut icon" type="image/png" href="https://res.cloudinary.com/dkgtd3pil/image/upload/v1554896611/other_data/pngtree_color_internet_programming_icon_internet_png_image_621325_icon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!--End of Dependencies. Comment out the above lines to remove any styling and front-end validation used.-->

</head>
<body class="container-fluid p-0 mt-3" style="background: whitesmoke;min-width: 293px;">

	<!--Div to display information messages in materialize-css toast format-->
	<div id="info" style="display: inline-block;position: absolute;top: 5%;right: 5%;z-index: 100"></div>

	<!--Headers to display developer information-->
	<div>
		<header class="d-none d-md-block">
			<div class="row w-100 m-0">
				<div class="col-sm-4 text-muted text-center">101538</div>
				<div class="col-sm-4 text-muted text-center">BICS Year 3 Sem 1 Group B</div>
				<div class="col-sm-4 text-muted text-center">IAP Lab 1</div>
			</div>
		</header>
		<header class="d-block d-md-none">
			<div class="d-flex justify-content-end" style="position: relative;right: 1.5rem"><a data-toggle="collapse" class="text-info" href="#my-info">Developer Info</a></div>
			<div id="my-info" class="collapse">
				<div class="d-flex justify-content-around">
					<div class="text-muted text-center">101538</div>
					<div class="text-muted text-center">BICS Y3 S1 GB</div>
					<div class="text-muted text-center">IAP Lab 1</div>
				</div>
			</div>
		</header>
	</div>

	<!--Start of Assignment Work-->
	
	<!--Display Information i.e error or success messages. This works like the codeigniter flashdata.-->
	<?php
		if(array_key_exists('info', $_SESSION)){ 
			echo '<div style="display: inline-block;position: absolute;top: 5%;right: 5%;z-index: 99">'.$_SESSION['info'].'</div>';
			$_SESSION = array();
		}
	?>
	<div class="mb-4 mt-2 row w-100 m-0">
		<div class="col-sm-12 col-md-2 col-lg-4"></div>
		<div class="col-sm-12 col-md-8 col-lg-4">
			<form method="post" onsubmit="return validation()">
				<table class="table table-borderless" align="center">
					<tr>
						<td align="center"><input type="text" name="first_name" class="form-control" placeholder="First Name" required></td>
					</tr>
					<tr>
						<td align="center"><input type="text" name="last_name" class="form-control" placeholder="Last Name" required></td>
					</tr>
					<tr>
						<td align="center"><input type="text" name="city_name" class="form-control" placeholder="City" required></td>
					</tr>
					<tr>
						<td align="center"><button type="submit" class="btn btn-success w-100" name="btn-save"><strong>SAVE</strong></button></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="col-sm-12 col-md-2 col-lg-4"></div>
	</div>
	<!--Display Records in the Database-->
	<?php if($data){?>
		<div class="container table-responsive-md">
			<table align="center" class="table table-borderless table-hover table-striped w-100">
				<thead class="table-secondary">
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>City</th>
					</tr>
				</thead>
				<tbody>
					<?php while($row = $data->fetch_assoc()){?>
						<tr>
							<td><?=$row['id']?></td>
							<td><?=$row['first_name']?></td>
							<td><?=$row['last_name']?></td>
							<td><?=$row['user_city']?></td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	<?php }else{?>
		<!--Display this if Database is Empty-->
		<div class="container">
			<div class="text-center text-muted" style="background: transparent;"><h3>No records to show here!</h3></div>
		</div>
	<?php }?>

	<!--End of Assignment work :)-->

</body>

<!--Input Validation Script (Front-End Validation)-->
<script>
	$('input[name=first_name]').focus()
	$('.toast').toast('show')
	function validation(){
		var first_name = $('input[name=first_name]').val().trim()
		var last_name = $('input[name=last_name]').val().trim()
		var city_name = $('input[name=city_name').val().trim()
		var data = [first_name,last_name,city_name]
		for(index in data){
			if(data[index].length<1){
				$('#info').html('<div class="toast" data-delay="3000"><div class="toast-body bg-danger text-light"><strong>Error: </strong>Ensure You Have Filled all Fields!</div></div>').find('.toast').toast('show')
				return false
			}
			if(/[^a-z0-9 \'-]/i.test(data[index])){
				$('#info').html('<div class="toast" data-delay="3000"><div class="toast-body bg-danger text-light"><strong>Error: </strong>Only Alphanumeric Characters are Required!</div></div>').find('.toast').toast('show')
				return false
			}
		}
		return true;
	}
</script>
<!--End of Validation Script-->
</html>