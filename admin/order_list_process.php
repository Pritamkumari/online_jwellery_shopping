<?php 
	include '../includes/db.php';
	
	if( isset($_REQUEST['order_status'])){
		$up_sql = "UPDATE orders SET order_status = '$_REQUEST[order_status]' WHERE order_id = '$_REQUEST[order_id]'";
		$up_run = mysqli_query($conn, $up_sql);
	}
	if( isset($_REQUEST['order_return_status'])){
		$up_return_sql = "UPDATE orders SET order_return_status = '$_REQUEST[order_return_status]' WHERE order_id = '$_REQUEST[order_id]'";
		$up_run = mysqli_query($conn, $up_return_sql);
	}
?>
<table class="table table-bordered table-striped">
					<thead>
						<tr class="item-head">
							<th>S.No.</th>
							<th>Buyer Name</th>
							<th>Buyer Email</th>
							<th>Buyer Contact</th>
							<th>Buyer State</th>
							<th>Delivery Address</th>
							<th>Order ref</th>
							<th class="text-right">Total Payment</th>
							<th>Order Status</th>
							<th>Return Status</th>
							
						</tr>
					</thead>
					<tbody>	
						<?php 
							$c = 1;
							$sql = "SELECT * FROM orders";
							$run = mysqli_query($conn, $sql);
							while($rows = mysqli_fetch_assoc($run)){
								if($rows['order_status'] == 0){
									$status_btn_class = 'btn-warning';
									$status_btn_value = 'Pending';
								}else{
									$status_btn_class = 'btn-success';
									$status_btn_value = 'Sent';
								}
								if($rows['order_return_status'] == 1){
									$return_btn_class = 'btn-danger';
									$return_btn_value = 'Returned';
								}else{
									$return_btn_class = 'btn-primary';
									$return_btn_value = 'No Return';
								}
								echo "
									<tr>
										<td>$c</td>
										<td>$rows[order_name]</td>
										<td>$rows[order_email]</td>
										<td>$rows[order_contact]</td>
										<td>$rows[order_state]</td>
										<td>$rows[order_delivery_address]</td>
										<td>
											<button class='btn btn-info' data-toggle='modal' data-target='#order_chk_modal$rows[order_id]'>
												$rows[order_checkout_ref]
											</button>
											<div class='modal fade' id='order_chk_modal$rows[order_id]'>
												<div class='modal-dialog'>
													<div class='modal-content'>
														<div class='modal-header'></div>
														<div class='modal-body'>
															<table class='table'>
																<thead>
																	<tr>
																		<th>S.No.</th>
																		<th>Item</th>
																		<th>Qty</th>
																		<th class=text-right>Discounted Price</th>
																		<th class='text-right'>Sub Total</th>
																	</tr>
																</thead>
																<tbody> ";
																//$chk_sql = "SELECT * FROM checkout WHERE chk_ref = '$rows[order_checkout_ref]'";
																$c = 1;
																$delivery_charge = 0;
																$chk_sql = "SELECT * FROM checkout c JOIN items i ON c.chk_item = i.item_id WHERE c.chk_ref = '$rows[order_checkout_ref]'";
																$chk_run = mysqli_query($conn, $chk_sql);
																while($chk_rows = mysqli_fetch_assoc($chk_run)){
																	if($chk_rows['item_title'] == ''){
																		$item_title = 'Sorry Data Deleted';
																	}else{
																		$item_title = $chk_rows['item_title'];
																	}
																	$item_price_discount = $chk_rows['item_price'] - $chk_rows['item_discount'];
																	$total = $chk_rows['chk_qty'] * $item_price_discount;
																	$delivery_charge = $delivery_charge + $chk_rows['item_delivery'];
																	
																	echo "
																		<tr>
																			<td>$c</td>
																			<td>$item_title</td>
																			<td>$chk_rows[chk_qty]</td>
																			<td class='text-right'>$item_price_discount/=</td>
																			<td class='text-right'>$total/=</td>
																		</tr>
																	";
																	$c++;
																}
																	
																
															echo "
																</tbody>
															</table>
															<table class='table'>
																<thead>
																	<tr>
																		<th colspan='2' class='text-center'>Order Summary</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Delivery Charge</td>
																		<td class='text-right'>$delivery_charge/=</td>
																	</tr>
																	<tr>
																		<td>Grand Total</td>
																		<td class='text-right'>$rows[order_total]/=</td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class='modal-footer'></div>
													</div>
												</div>
											</div>
										</td>
										<td class='text-right'>$rows[order_total]/=</td> "; ?>
										<td class='text-center'>
											<button class='btn btn-block btn-sm <?php echo $status_btn_class; ?>' onclick="order_status(<?php echo $rows['order_status'].', '.$rows['order_id'];?>);">
												<?php echo $status_btn_value; ?>
											</button>
										</td>
										<td class="text-center">
											<button class="btn btn-sm <?php echo $return_btn_class;?>" onclick="return_status(<?php echo $rows['order_return_status'].', '.$rows['order_id']?>)">
												<?php echo $return_btn_value ;?>
											</button>
										</td>
									</tr>
									<?php echo "
								";
								$c++;
							}
						?>
						
					</tbody>
				</table>
