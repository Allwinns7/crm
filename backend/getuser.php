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
	$sql = "SELECT * FROM `emps` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();

		if($account['acc_status']==0) {
			$act = 'Active';
		}
		else {
			$act = 'In-Active';
		}

		$result['status'] = 'success';
		$result['username'] = $account['username'];
		$result['fname'] = $account['fname'];
		$result['lname'] = $com_fet['lname'];
		$result['email'] = $account['email'];
		$result['phone'] = $account['phone'];
		$result['gender'] = $account['gender'];
		$result['utype'] = $account['type'];
		$result['password'] = $account['password'];
		$result['created_time'] = $account['created_time'];
		$result['utype'] = $account['type'];
		$result['eid'] = $id;
		$result['acstatus'] = $act;
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'User doesnot exists';
	}	
}

print json_encode($result);