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
	$sql = "SELECT * FROM `accounts` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$result['status'] = 'success';
		$result['name'] = $account['name'];
		$result['owner'] = $account['owner'];
		$result['type'] = $account['type'];
		$result['email'] = $account['email'];
		$result['website'] = $account['website'];
		$result['phone'] = $account['phone'];
		$result['description'] = $account['description'];
		$result['industry'] = $account['industry'];
		$result['employees'] = $account['employees'];
		$result['baddress'] = $account['baddress'];
		$result['bstreet'] = $account['bstreet'];
		$result['bcity'] = $account['bcity'];
		$result['bstate'] = $account['bstate'];
		$result['bzip'] = $account['bzip'];
		$result['bcountry'] = $account['bcountry'];
		$result['saddress'] = $account['saddress'];
		$result['sstreet'] = $account['sstreet'];
		$result['scity'] = $account['scity'];
		$result['sstate'] = $account['sstate'];
		$result['szip'] = $account['szip'];
		$result['scountry'] = $account['scountry'];
		$result['id'] = $account['id'];
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Account doesnot exists';
	}	
}

print json_encode($result);