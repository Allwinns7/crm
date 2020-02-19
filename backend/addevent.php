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

	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$location = $_POST['location'];
	$eventt = $_POST['eventt'];
	$contacts = $_POST['contacts'];
	$leads = $_POST['leads'];
	$teams = $_POST['teams'];

	$result = array();

	$sql = "INSERT INTO `calendar` VALUES (NULL,'$start', '$end', '$title', '$location', '$eventt', $contacts, $leads, $user_id, '$created_time')";
	$exe = $conn->query($sql);

	if($teams!=0) {
		$get_tem = $conn->query("SELECT * FROM `emps` WHERE team=$teams");
		while($all_tms = $get_tem->fetch_assoc()) {
			$tuid = $all_tms['id'];
			$ins_tm = $conn->query("INSERT INTO `calendar` VALUES(NULL, '$start', '$end', '$title', '$location', '$eventt', $contacts, $leads, $tuid, '$created_time')");
		}
	}
	
	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Event Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Event, Try later';
	}
}

print json_encode($result);