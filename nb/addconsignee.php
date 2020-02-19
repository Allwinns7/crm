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
	$consignee_name = $_POST['consignee_name'];
	$consignee_address = $_POST['consignee_address'];

	

	$sql = "INSERT INTO `arm_consignee` VALUES (NULL,'$consignee_name','$consignee_address')";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Consignee Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Consignee, Try later';
	}
}

print json_encode($result);