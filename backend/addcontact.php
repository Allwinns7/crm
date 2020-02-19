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

	$name = $_POST['name'];
	$email = $_POST['email'];
	$convert_id = $_POST['convert_id'] ?: 0;
	$phone = $_POST['phone'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$description = $_POST['desc'];
	$acc_id = $_POST['acc_id'];

	$result = array();

	$sql = "INSERT INTO `contacts` VALUES (NULL,'$name', '$email', '$phone', '$city', '$country', '$description', $acc_id, $user_id, '$created_time', $convert_id)";
	$exe = $conn->query($sql);
	
	if($exe==TRUE) {

		if($convert_id!=0) {
			$message = "Converted to Contact";
			$lead_act = $conn->query("INSERT INTO `lead_activity` VALUES (NULL,'$message',$convert_id,'$created_time')");
		}

		$result['status'] = 'success';
		$result['message'] = 'Contact Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Contact, Try later';
	}
}

print json_encode($result);