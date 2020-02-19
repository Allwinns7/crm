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

	$acc_name = $_POST['acc_name'];
	$convert_id = $_POST['convert_id'] ?: 0;
	$acc_own = $_POST['acc_own'];
	$type = $_POST['type'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$phone = $_POST['phone'];
	$desc = $_POST['desc'];
	$industry = $_POST['industry'];
	$emps = $_POST['emps'];
	$baddress = $_POST['baddress'];
	$bstreet = $_POST['bstreet'];
	$bcity = $_POST['bcity'];
	$bstate = $_POST['bstate'];
	$bzip = $_POST['bzip'];
	$bcountry = $_POST['bcountry'];
	$saddress = $_POST['saddress'];
	$sstreet = $_POST['sstreet'];
	$scity = $_POST['scity'];
	$sstate = $_POST['sstate'];
	$szip = $_POST['szip'];
	$scountry = $_POST['scountry'];

	$result = array();

	$sql = "INSERT INTO `accounts` VALUES (NULL,'$acc_name', '$acc_own', '$type', '$email', '$website', '$phone', '$desc', '$industry', $emps, '$baddress', '$bstreet', '$bcity', '$bstate', '$bzip', '$bcountry', '$saddress', '$sstreet', '$scity', '$sstate', '$szip', '$scountry', $user_id, '$created_time','$created_time', $convert_id)";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		if($convert_id!=0) {

			$message = "Converted to Account";
			$lead_act = $conn->query("INSERT INTO `lead_activity` VALUES (NULL,'$message',$convert_id,'$created_time')");
		}
		$result['status'] = 'success';
		$result['message'] = 'Account Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Account, Try later';
	}
}

print json_encode($result);