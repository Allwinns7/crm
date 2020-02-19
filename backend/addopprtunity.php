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
	$acc_id = $_POST['acc_id'];
	$stage = $_POST['stage'];
	$amount = $_POST['amount'];
	$convert_id = $_POST['convert_id'] ?: 0;
	$propability = $_POST['propability'];
	$closing = $_POST['closing'];
	$contact = $_POST['contact'];
	$lead = $_POST['lead'];
	$desc = $_POST['desc'];

	$result = array();

	$sql = "INSERT INTO `oppurtunity` VALUES (NULL,'$name', $acc_id, '$stage', $amount, $propability, '$closing', $contact, '$lead', '$desc', $user_id, '$created_time', $convert_id)";
	$exe = $conn->query($sql);
	$lat_id = $conn->insert_id;
	
	if($exe==TRUE) {

		if($convert_id!=0) {
			$message = "Converted to Oppurtunity";
			$lead_act = $conn->query("INSERT INTO `lead_activity` VALUES (NULL,'$message',$convert_id,'$created_time')");
		}

		$instruction = '<a href="oppurtunity.php?id='.$lat_id.'"><i class="fa fa-dot-circle-o color-green"></i> New Oppurtunity assigned</a>';
		$notifi = "INSERT INTO `notifications` VALUES(NULL,'$instruction',$assigned_to, '$created_time', 1)";

		$result['status'] = 'success';
		$result['message'] = 'Oppurtunity Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Oppurtunity, Try later';
	}
}

print json_encode($result);