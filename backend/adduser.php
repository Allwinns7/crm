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
	$user_id = $_SESSION['user_id'];
	$created_time = date('Y-m-d H:i:s');

	$uname = $_POST['uname'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];
	$acc_type = $_POST['acc_type'];
	$active = $_POST['active'];
	if($active=='on') {
		$act = 0;
	}
	else {
		$act = 1;
	}
	$api = RandomString();

	$result = array();

	$sql = "INSERT INTO `emps` VALUES (NULL,'$uname', '$password', '$fname', '$lname', '$email', '$phone', '$gender', '$acc_type', '$api', '$created_time', '0000-00-00 00:00:00', $act, 0, '')";
	$exe = $conn->query($sql);

	if($exe==TRUE) {

		$result['status'] = 'success';
		$result['message'] = 'User Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create User, Try later';
	}
}


function RandomString(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

print json_encode($result);