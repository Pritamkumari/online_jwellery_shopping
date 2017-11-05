<?php 
	session_start();
	include 'includes/db.php';
	$date = date('Y-m-d h:i:s');
	$rand_num = mt_rand();
	if( isset($_SESSION['ref'])){
		
	}else{
		$_SESSION['ref'] = $date.'_'.$rand_num;
	}
	@$chk_item_id = $_GET[chk_item_id];
	$chk_sql = "INSERT INTO checkout (chk_item, chk_ref, chk_timing, chk_qty) VALUES('$chk_item_id', '$_SESSION[ref]', '$date', 1)";
	mysqli_query($conn, $chk_sql);
	/*if(mysqli_query($conn, $chk_sql)){
		?>  <script></script><?php
	}*/
	
	if(isset($_POST['order_submit'])){
		$name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
		$email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
		$contact = mysqli_real_escape_string($conn,strip_tags($_POST['contact']));
		$state = mysqli_real_escape_string($conn,strip_tags($_POST['state']));
		$delivery_address = mysqli_real_escape_string($conn,strip_tags($_POST['delivery_address']));
		
		$order_ins_sql = "INSERT INTO orders (order_name, order_email, order_contact, order_state,
		order_delivery_address, order_checkout_ref, order_total, order_status, order_return_status) VALUES ('$name','$email','$contact','$state','
		$delivery_address','$_SESSION[ref]','$_SESSION[grand_total]',0,0)";
		
		if(mysqli_query($conn, $order_ins_sql)){
                ?> <script>window.location = "thank.php"; </script> <?php
               }
	}
?>
<html>
	<head>
		<title>Shopping Cart</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script>
		
		/*	function ajax_func(){
				alert('hi');
				
				xmlhttp = new XMLHttpRequest();
				xmlhttp.openreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('summary').innerHTML = xmlhttp.responseText;
					}
					
				}
				
				xmlhttp.open('GET', 'buy_process.php', true);
				xmlhttp.send();
				
			}*/
			
			$(document).ready(function(){
				//alert('hell');
				call();
				//ajax_func();
							
			});
			function call(){
					
					$.ajax({
				
					type:'GET',
					url:'buy_process.php',
					beforeSend:function(){
						
					},
					success:function(response){
						$('#get_processed_data').html(response);
						
					}
					
				});
				}
				function ajax_func(){
					
					$.ajax({
				
					type:'GET',
					url:'buy_process.php',
					beforeSend:function(){
						
					},
					success:function(response){
						$('#summary').html(response);
						
					}
					
				});
				}
			function del_func(chk_id){
				//alert(chk_id);
				xmlhttp = new XMLHttpRequest();
				xmlhttp.openreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_processed_data').innerHTML = xmlhttp.responseText;
					}
					
				}
				
				xmlhttp.open('GET', 'buy_process.php?chk_del_id='+chk_id, true);
				xmlhttp.send();
				call();
			}
			function up_chk_qty(chk_qty, chk_id){
				//alert(chk_qty);
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById('get_processed_data').innerHTML = xmlhttp.responseText;
					}	
				}
				xmlhttp.open('GET', 'buy_process.php?up_chk_qty='+chk_qty+'&up_chk_id='+chk_id, true);
				xmlhttp.send();
				//alert(chk_qty);
			}
		</script>
		
		<style>
			body{
				background: silver;
			}
			.panel{
				border-radius: 0;
			}
			.btn {
				border-radius: 0;
			}
			.form-control{
				border-radius: 0;
		}
		</style>
	</head>
	<body >
		<?php include 'includes/header.php';?>
		<div class="container">
			<div class="page-header">
				<h2 class="pull-left">Checkout</h2>
				<div class="pull-right"><button class="btn btn-success" data-toggle="modal" data-target="#proceed_modal" data-backdrop="static" data-keyboard="false">Proceed</button></div>
				<!-- The Proceed Form Modal -->
				<div id="proceed_modal" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form method="post">
									<div class="form-group">
										<label>Name</label>
										<input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
									</div>
									<div class="form-group">
										<label for="contact">Contact Number</label>
										<input type="text" id="contact" name="contact" class="form-control" placeholder="Contact Number" required>
									</div>
									<div class="form-group">
										<label for="state">State</label>
										<input list="states" name="state" id="state"class="form-control" required>
										<datalist id="states">
											<option>Bihar</option>
											<option>Uttar Pradesh</option>
											<option>Punjab</option>
											<option>Jharkhand</option>
											<option>West Bengal</option>
											<option>Jammu & Kashmir</option>
											<option>Rajasthan</option>
										</datalist>
									</div>
									<div class="form-group">
										<label for="address">Delivery Address</label>
										<textarea class="form-control" name="delivery_address" required></textarea>
									</div>
									<div class="form-group">
										<input type="submit" name="order_submit"class="btn btn-danger btn-block" >
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Order Detail</div>
				<div class="panel-body" >
					<div id="get_processed_data"></div>
				<!--	<table class="table">
						<thead>
							<tr>
								<th>S. No.</th>
								<th>Item</th>
								<th>qty</th>
								<th width="5%">Delete</th>
								<th class="text-right">Price</th>
								<th class="text-right">Total</th>
								
							</tr>
						</thead>
						<tbody>
							
							
								
									
						</tbody>
					</table>
					<table class="table">
						<thead>
							<tr>
								<th class="text-center" colspan="2">Oder Summary</th>
							</tr>
						</thead>
						<tbody id="summary">
							<tr>
								<td>Subtotal</td>
								<td class="text-right"><b>500/=</b></td>
							</tr>
							<tr>
								<td>Delivery Charges</td>
								<td class="text-right"><b>Free</b></td>
							</tr>
							<tr>
								<td>Grand Total</td>
								<td class="text-right"><b>500/=</b></td>
							</tr> 
						</tbody>
					</table> -->
				</div>
			</div>
		</div>
		<br><br><br><br><br><br><br><br><br><br>
		<?php include 'includes/footer.php';?>
	</body>
</html>
