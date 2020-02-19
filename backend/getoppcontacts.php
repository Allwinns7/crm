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
	$sql = "SELECT * FROM `contacts` WHERE acc_id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		while($account = $sql_exe->fetch_assoc()) {
			$row_array['status'] = 'success';
			$row_array['name'] = $account['name'];
			$row_array['id'] = $account['id'];

			array_push($result,$row_array);  

		}
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Contact doesnot exists';
	}	
}

print json_encode($result);