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
	$sql = "SELECT * FROM `contacts` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$cmp_id = $account['acc_id'];
		$com_det = "SELECT * FROM `accounts` WHERE `id`=$cmp_id";
		$com_exe = $conn->query($com_det);
		$com_fet = $com_exe->fetch_assoc();
		$result['status'] = 'success';
		$result['name'] = $account['name'];
		$result['account'] = $com_fet['name'];
		$result['email'] = $account['email'];
		$result['phone'] = $account['phone'];
		$result['city'] = $account['city'];
		$result['country'] = $account['country'];
		$result['description'] = $account['description'];
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Contact doesnot exists';
	}	
}

print json_encode($result);