<?php 	

require_once 'core.php';

$sql = "SELECT order_id, order_date, client_name, client_email, payment_status, total_amount, paid FROM arm_purchase WHERE order_status = 1";
$result = $connect->query($sql);


$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];

 	$clinetSQL = "SELECT * FROM accounts WHERE id = $row[2]";
 	$clinetSQLResult = $connect->query($clinetSQL);
 	$clientDetail = $clinetSQLResult->fetch_row();
 	$client = $clientDetail[1];

 	$countOrderItemSql = "SELECT count(*) FROM arm_sales_item WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[4] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Full Payment</label>";
 	} 
 	else if($row[4] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
 	} 
 	else { 		
 		$paymentStatus = "<label class='label label-warning'>No Payment</label>";
 	} // /else

 	$button = '<center>
	      <a href="purchasedetals.php?id='.$orderId.'" class="btn custom_btn custom_fontcolor btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	      <a href="" class="deletePurchase btn btn-danger btn-sm" name="20200120151059" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
	</center>';		

 	$output['data'][] = array( 		
 		// image
 		$x,
 		// order date
 		'<a href="purchasedetails.php?id='.$x.'&sn='.$client.'&pno=P000'.$x.'&pdate='.$row[1].'">P000'.$x.'</a>',
 		// client name
 		$client, 		 	
 		$row[1], 		 	
 		'$'.$row[5],
 		'$'.$row[6],
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);