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

	$id =$_POST['id'];
	$stat = $_POST['stat'];

	$placed = date('Y-m-d H:i:s');

	$sql = "UPDATE `tbl_order` SET `order_converted`=1, `converted_time`='$placed', `comments` = 'Converted to Order' WHERE `order_id`=$id";
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