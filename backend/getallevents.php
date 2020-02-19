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
	$id = $_POST['id'];
	$sql = "SELECT * FROM `calendar` WHERE start >= CURDATE() ORDER BY start ASC LIMIT 5";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		while($account = $sql_exe->fetch_assoc()) {
			$row_array['message'] = $account['message'];
			$row_array['location'] = $account['location'];
			$row_array['day'] = date("j",strtotime($account['start']));
			$row_array['month'] = date("M",strtotime($account['start']));

			array_push($result,$row_array);  

		}
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Event doesnot exists';
	}	
}

print json_encode($result);