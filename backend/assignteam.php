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

	$userid = $_POST['userid'];
	$groupid = $_POST['groupid'];

	$sql = "UPDATE `emps` SET `team`=$groupid WHERE `id`=$userid";
	$sql_exe = $conn->query($sql);
	if($sql_exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Group Assigned Successfully';
	}

	else {
		$result['status'] = 'failure';
		$result['message'] = 'Failed to Assign Group';
	}	
}

print json_encode($result);