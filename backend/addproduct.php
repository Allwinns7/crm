<?php
include('conn.php');
session_start();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

if($user==''||$token=='') {
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
}
else {


	$name = $_POST['name'];
	$price = $_POST['price'];
	$sku = $_POST['sku'];

	$result = array();

	$sql = "INSERT INTO `tbl_products` VALUES (NULL,'$name', $price, '$sku')";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Product Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Product, Try later';
	}
}

print json_encode($result);