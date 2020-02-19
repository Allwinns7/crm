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
	$sql = "SELECT * FROM `leads` ORDER BY fname ASC LIMIT 5";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		while($account = $sql_exe->fetch_assoc()) {
			$row_array['status'] = 'success';
			$row_array['name'] = $account['fname'];
			$row_array['acc'] = $account['acc'];
			$row_array['id'] = $account['id'];
			$row_array['statuses'] = $account['status'];

			array_push($result,$row_array);  

		}
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Leads doesnot exists';
	}	
}

print json_encode($result);