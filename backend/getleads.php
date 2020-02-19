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
	$sql = "SELECT * FROM `leads` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$result['status'] = 'success';
		$result['fname'] = $account['fname'];
		$result['lname'] = $account['lname'];
		$result['acc'] = $account['acc'];
		$result['email'] = $account['email'];
		$result['website'] = $account['website'];
		$result['phone'] = $account['phone'];
		$result['desc'] = $account['desc'];
		$result['title'] = $account['title'];
		$result['industry'] = $account['industry'];
		$result['assigned_to'] = $account['assigned_to'];
		
		$result['street'] = $account['street'];
		$result['city'] = $account['city'];
		$result['state'] = $account['state'];
		$result['zip'] = $account['zip'];
		$result['country'] = $account['country'];
		$result['lstatus'] = $account['status'];
		$result['source'] = $account['source'];
		$result['oppr'] = $account['opp'];

		$result['id'] = $account['id'];
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Lead doesnot exists';
	}	
}

print json_encode($result);