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
	$party_name = $_POST['party_name'];
	$party_address = $_POST['party_address'];

	

	$sql = "INSERT INTO `arm_notifyparty` VALUES (NULL,'$party_name','$party_address')";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Party Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Party, Try later';
	}
}

print json_encode($result);