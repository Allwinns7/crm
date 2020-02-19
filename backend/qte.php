<?php
include('conn.php');
session_start();

$result = array();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

if($user==''||$token=='') {
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
}
else {

$order_date = date('Y-m-d');
$order_receiver_name = $_POST['order_receiver_name'];
$order_receiver_email = $_POST['order_receiver_email'];
$order_receiver_address = $_POST['order_receiver_address'];
$paymentbank = $_POST['paymentbank'];
$bankdetails = $_POST['bankdetails'];
$paymentterm = $_POST['paymentterm'];
$specification = $_POST['specification'];
$packaging = $_POST['packaging'];
$shipper = $_POST['shipper'];

	$sql = "INSERT INTO `arm_quote` (order_date, order_receiver_name, order_receiver_email, order_receiver_address, packaging, bankdetails, paymentterm, specification, shipper) VALUES ('$order_date', $order_receiver_name, '$order_receiver_email', '$order_receiver_address', '$packaging', '$bankdetails', '$paymentterm', '$specification', '$shipper')";
	//print_r($sql);die;
	$exe = $conn->query($sql);

	if($exe==TRUE) {	


	$latest_sql = "SELECT * FROM `arm_quote` ORDER BY id DESC";
	$lates_exe = $conn->query($latest_sql);

	$last_id = $lates_exe->fetch_assoc();
	$lid = $last_id['id'];
		
		for($count=0; $count<$_POST["total_item"]; $count++)
	      {

	      	$item_name = $_POST["item_name"][$count];
	      	$order_item_garnet = $_POST["order_item_garnet"][$count];
	      	$order_item_grade = $_POST["order_item_grade"][$count];
	      	$order_item_actual_amount = $_POST["order_item_actual_amount"][$count];

	      	$item_sql = "INSERT INTO `arm_quote_item` VALUES (NULL,'$lid', '$item_name', '$order_item_garnet', '$order_item_grade', '$order_item_actual_amount')";
	      	$item_exe = $conn->query($item_sql);

	      	if($item_exe) {

	      		$result['status'] = 'success';
				$result['message'] = 'Invoice Created Succcessfully!!';

	      	}

	      }

	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create quotation, Try later';
	}
	
}
print json_encode($result);