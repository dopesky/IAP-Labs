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
</head>
<body>
	<div id="container">
		<h1><b>It is time to Communicate with an Exposed API. All We Need is the API KEY to be Passed in the Header!</b></h1>
		<h6 class="ml-2"><b>1. Feature 1 - Placing an Order</b></h6>
		<div id="body" class="mb-3">
			<form action="http://localhost/Html/IAP/Lab4/api/v1/orders/index.php" onsubmit="submitForm(event)" name="order_form">
				<fieldset>
					<input type="text" placeholder="Username" name="username" class="form-control" required>
					<br>
					<input type="text" placeholder="Name of Food" name="name_of_food" class="form-control" required>
					<br>
					<input type="number" placeholder="Number of Units" name="number_of_units" class="form-control" required>
					<br>
					<input type="number" placeholder="Unit Price" name="unit_price" class="form-control" required>
					<br>
					<input type="hidden" value="order placed" name="status" class="form-control" required>
					<br>
					<button class="btn btn-primary" type="submit">Place Order</button>
				</fieldset>
			</form>
		</div>
		<h6 class="ml-2"><b>2. Feature 2 - Fetching Order Status</b></h6>
		<div id="body2" class="mb-3">
			<form action="http://localhost/Html/IAP/Lab4/api/v1/orders/index.php" onsubmit="submitFormStatus(event)" name="status_form">
				<fieldset>
					<input type="text" placeholder="Username" name="username" class="form-control" required>
					<br>
					<input type="text" placeholder="Order ID" name="order_id" class="form-control" required>
					<br>
					<button class="btn btn-warning" type="submit">Check Order Status</button>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>
<script>
	async function submitForm(event){
		event.preventDefault()
		let response = null;
		try{
			response = await $.ajax({
				url: $(event.currentTarget).attr('action'),
				data: $(event.currentTarget).serialize(),
				headers: {
					'APIKEY' : 'zg5gonweDmZrHZhz9HuKHqFrmAsXv8OIirZLUG4iVX3syiMFlNEivUW2nuGenJIq'
				},
				dataType: 'json',
				method: 'POST'
			})
		}catch(ex){
			response = ex.responseJSON
		}finally{
			if(response.success){
				$("#body").prepend("<div class='alert alert-success m-3 alert-dismissable'>"+response.message+"<button class='close' data-dismiss='alert'>&times;</button></div>")
				event.target.reset()
			}else{
				$("#body").prepend("<div class='alert alert-danger m-3 alert-dismissable'>"+response.message+"<button class='close' data-dismiss='alert'>&times;</button></div>")
			}
		}
	}
	async function submitFormStatus(event){
		event.preventDefault()
		let response = null;
		try{
			response = await $.ajax({
				url: $(event.currentTarget).attr('action'),
				data: $(event.currentTarget).serialize(),
				headers: {
					'APIKEY' : 'zg5gonweDmZrHZhz9HuKHqFrmAsXv8OIirZLUG4iVX3syiMFlNEivUW2nuGenJIq'
				},
				dataType: 'json',
				method: 'GET'
			})
		}catch(ex){
			response = ex.responseJSON
		}finally{
			if(response.success){
				$("#body2").prepend("<div class='alert alert-success m-3 alert-dismissable'><b>Order Status: </b>"+response.message+"<button class='close' data-dismiss='alert'>&times;</button></div>")
				event.target.reset()
			}else{
				$("#body2").prepend("<div class='alert alert-danger m-3 alert-dismissable'>"+response.message+"<button class='close' data-dismiss='alert'>&times;</button></div>")
			}
		}
	}
</script>