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
	$user_id = $_SESSION['user_id'];
	$created_time = date('Y-m-d H:i:s');

	$supplier_name = $_POST['supplier_name'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$details = $_POST['details'];
	$previous_balance = $_POST['previous_balance'];


	$result = array();

	$sql = "INSERT INTO `suppliers` VALUES (NULL,'$supplier_name', '$mobile', '$address', '$details', '$previous_balance', $user_id, '$created_time')";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Account Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Account, Try later';
	}
}

print json_encode($result);