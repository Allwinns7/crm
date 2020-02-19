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

	$id =$_POST['dec_id'];
	$stat = $_POST['reason'];

	$sql = "UPDATE `leads` SET `status`='$stat', `is_changed`=1 WHERE `id`=$id";
	$sql_exe = $conn->query($sql);
	if($sql_exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Status Changed';
	}

	else {
		$result['status'] = 'failure';
		$result['message'] = 'Failed to update status';
	}	
}

print json_encode($result);