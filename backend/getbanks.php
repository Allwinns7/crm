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
	$sql = "SELECT * FROM `arm_bank` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$result['status'] = 'success';
		$result['bank_name'] = $account['bank_name'];
		$result['currency'] = $account['currency'];
		$result['ac_name'] = $account['ac_name'];
		$result['ac_no'] = $account['ac_no'];
		$result['branch'] = $account['branch'];
		$result['balance'] = $account['balance'];
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Bank doesnot exists';
	}	
}

print json_encode($result);