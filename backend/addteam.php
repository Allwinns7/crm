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

	$name = $_POST['groupname'];
	$record_time = date('Y-m-d H:i:s');

	$check = "SELECT * FROM teams WHERE name='$name'";
	$check_exe = $conn->query($check);
	$count = mysqli_num_rows($check_exe);

	$result = array();

	if($count==0){
	
	$sql = "INSERT INTO teams VALUES(NULL,'$name','$record_time')";
	$exe = $conn->query($sql);
		if($exe==TRUE){
				$result['status'] = 'success';
				$result['message'] = 'Group Created Successfully';
		}
		else {	
				$result['status'] = 'failed';
				$result['message'] = 'Failed to Create Group';
		}	
	}
	else {
				$result['status'] = 'failed';
				$result['message'] = 'Group name already exist';
	}

}
print json_encode($result);