<?php
include('conn.php');
session_start();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

$result = array();

if($user==''||$token=='') {
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
}
else {
	$delivery_term = $_POST['delivery_term'];


	$sql = "INSERT INTO `arm_delivery_terms` VALUES (NULL,'$delivery_term')";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Delivery Term Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Delivery Term, Try later';
	}
}

print json_encode($result);