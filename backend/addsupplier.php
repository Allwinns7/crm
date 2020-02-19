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

	$acc_name = $_POST['acc_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$address = $_POST['address'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$zip = $_POST['zip'];

	$result = array();

	$sql = "INSERT INTO `arm_suppliers` VALUES (NULL,'$acc_name', '$email', '$phone', '$address', '$street', '$city', '$state', '$zip', '$country', $user_id, '$created_time','$created_time')";
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