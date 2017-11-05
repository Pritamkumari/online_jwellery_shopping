<?php include '../includes/db.php';
	if( isset($_REQUEST['del_item_id'])){
		$del_sql = "DELETE FROM items WHERE item_id = '$_REQUEST[del_item_id]'";
		mysqli_query($conn, $del_sql);	
	}
	if(isset($_REQUEST['up_item_id'])){
		$item_title = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_title']));
		$item_description = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_description']));
		$item_category = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_category']));
		$item_quantity = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_quantity']));
		$item_cost = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_cost']));
		$item_price = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_price']));
		$item_discount = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_discount']));
		$item_delivery = mysqli_real_escape_string($conn, strip_tags($_REQUEST['item_delivery']));
		$item_id = $_REQUEST['up_item_id'];
		
		/*$item_ins_sql = "INSERT INTO items (item_title, item_description, item_cat, 
					item_qty, item_cost, item_price, item_discount, item_delivery) values ( 
					'$item_title', '$item_description', '$item_category', '$item_quantity', '$item_cost', '$item_price',
					'$item_discount', '$item_delivery');";*/
					//echo up_item_id;
		$item_up_sql = "UPDATE items SET item_title='$item_title', item_description='$item_description', 
					item_cat='$item_category', item_qty='$item_quantity', item_cost='$item_cost',
					item_price='$item_price', item_discount='$item_discount', item_delivery='$item_delivery' WHERE item_id = '$item_id'";
					
					$item_up_run = mysqli_query($conn, $item_up_sql);
	}
 ?>
<table class="table table-bordered table-striped">
				<thead class="item-head">
					<tr>
						<th>S.No.</th>
						<th>Image</th>
						<th>Item Title</th>
						<th>Item Description</th>
						<th>Item Category</th>
						<th>Item Qty</th>
						<th>Item Cost</th>
						<th>Item Discount</th>
						<th>Item Price</th>
						<th>Item Delivery</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$c = 1;
						$sel_sql = "SELECT * FROM items";
						$sel_run = mysqli_query($conn, $sel_sql);
						while($rows = mysqli_fetch_assoc($sel_run)){
							$discounted_price = $rows['item_price'] - $rows['item_discount'];
							echo "
								<tr>
									<td>$c</td>
									<td><img src='../$rows[item_image]' style='width: 60px;'></td>
									<td>$rows[item_title]</td>
									<td>"; echo strip_tags($rows['item_description']); echo "</td>
									<td>$rows[item_cat]</td>
									<td>$rows[item_qty]</td>
									<td>$rows[item_cost]</td>
									<td>$rows[item_discount]</td>
									<td>$discounted_price($rows[item_price])</td>
									<td>$rows[item_delivery]</td>
									<td>
										<div class='dropdown'>
											<button class='btn btn-red btn-danger dropdown-toggle'
											data-toggle='dropdown'>Actions<span class='caret'></span></button>
											<ul class='dropdown-menu dropdown-menu-right'>
												<li>
												<a href='#edit_modal' data-toggle='modal'>Edit</a>
												
												</li>"; ?>
												<li><a href="javascript:;" onclick="del_item(<?php echo $rows['item_id'];?>);">Delete</a></li>
												<?php echo "
											</ul>
										</div>
										<div class='modal fade' id='edit_modal'>
											<div class='modal-dialog'>
												<div class='modal-content'>
													<div class='modal-header'>
														<button class='close' data-dismiss='modal'>&times;</button>
														<h4 class='modal-title'>Edit Item</h4>
													</div>
													<div class='modal-body'>
														<div id='form1'>
															<div class='form-group'>
																<label>Item Title</label>
																<input type='text' value='$rows[item_title]' id='item_title' class='form-control'>
															</div>
															<div class='form-group'>
																<label>Item Description</label>
																<textarea id='item_description' value='$rows[item_description]' class='form-control'></textarea>
															</div>
															<div class='form-group'>
																<label>Item Category</label>
																<select class='form-control' id='item_category'>
																	<option>Select Category</option> ";
																	
																	
																		$cat_sql = "SELECT * FROM item_cat";
																		$cat_run = mysqli_query($conn,$cat_sql);
																		while($cat_rows =mysqli_fetch_assoc($cat_run)){
																			$cat_name = ucwords($cat_rows['cat_name']);
																			if($cat_rows['cat_slug'] == ' '){
																				$cat_slug = $cat_rows['cat_name'];
																			}
																			else{
																				$cat_slug =$cat_rows['cat_slug'];
																			}
																		
																			if( $cat_slug == $rows['item_cat']){
																				echo "
																				<option selected values='$cat_slug'>$cat_name</option>
																				";
																			}
																			else{
																				echo "
																				<option values='$cat_slug'>$cat_name</option>
																				";
																			}
																			
																		}
																	
																echo "</select>
															</div>
															<div class='form-group'>
																<label>Item Quantity</label>
																<input type='number' value='$rows[item_qty]' id='item_quantity' class='form-control'>
															</div>
															<div class='form-group'>
																<label>Item Cost</label>
																<input type='number' value='$rows[item_cost]' id='item_cost' class='form-control'>
															</div>
															<div class='form-group'>
																<label>Item Price</label>
																<input type='number' value='$rows[item_price]' id='item_price' class='form-control'>
															</div>
															<div class='form-group'>
																<label>Item Discount</label>
																<input type='number' value='$rows[item_discount]' id='item_discount' class='form-control'>
															</div>
															<div class='form-group'>
																<label>Item Delivery</label>
																<input type='number' value='$rows[item_delivery]' id='item_delivery' class='form-control'>
															</div>
															<div class='form-group'>
																<input type='hidden' id='up_item_id' value='$rows[item_id]'> "; ?>
																<button onclick="edit_item();" class="btn btn-primary btn-block" style="background: #4F8CC9">Submit</button>
															</div>
														</div>
													</div>
													<div class='modal-footer'>
														<button class='btn btn-red btn-danger' data-dismiss='modal'>Close</button>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<?php
							
							$c++;
						}
					?>
					
				</tbody>
			</table>
