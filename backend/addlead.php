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

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$acname = $_POST['acname'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$phone = $_POST['phone'];
	$title = $_POST['title'];
	
	
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$country = $_POST['country'];

	$status = $_POST['lstatus'];
	$source = $_POST['source'];
	$oppr = $_POST['oppr'];
	$industry = $_POST['industry'];
	$desc = $_POST['desc'];
	$assigned_to = $_POST['assigned_to'];
	

	$result = array();

	$sql = "INSERT INTO `leads` VALUES (NULL,'$fname', '$lname', '$acname', '$email', '$phone', '$title', '$website', '$street', '$city', '$state', '$zip', '$country', '$status', '$source', '$oppr', '$industry', '$desc', $assigned_to, $user_id, 0, '$created_time')";
	$exe = $conn->query($sql);
	$lat_id = $conn->insert_id;

	if($exe==TRUE) {

		$instruction = '<a href="leads_detail.php?id='.$lat_id.'"><i class="fa fa-dot-circle-o color-green"></i> New Lead assigned</a>';
		$notifi = "INSERT INTO `notifications` VALUES(NULL,'$instruction',$assigned_to, '$created_time', 1)";
		$exec = $conn->query($notifi);

		$result['status'] = 'success';
		$result['message'] = 'Lead Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create lead, Try later';
	}
}

print json_encode($result);