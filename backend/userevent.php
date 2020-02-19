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
	$sql = "SELECT * FROM `calendar` WHERE user=$user";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		while($account = $sql_exe->fetch_assoc()) {
			$row_array['title'] = 'message';
			$row_array['start'] = $account['start'];
			$row_array['end'] = $account['end'];

			array_push($result,$row_array);  

		}
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Events doesnot exists';
	}	
}

print json_encode($result);