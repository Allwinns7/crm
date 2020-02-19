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
	$sql = "SELECT * FROM `calendar` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();

		$lid = $account['leads'];
		$cid = $account['contacts'];

		$lead = "SELECT * FROM `leads` WHERE id=$lid";
		$lead_qu = $conn->query($lead);
		$lead_ftch = $lead_qu->fetch_assoc();

		$cts = "SELECT * FROM `contacts` WHERE id=$cid";
		$cts_qu = $conn->query($cts);
		$cts_ftch = $cts_qu->fetch_assoc();

		$result['status'] = 'success';
		$result['title'] = $account['message'];
		$result['start'] = $account['start'];
		$result['end'] = $account['end'];
		$result['lname'] = $lead_ftch['fname'];
		$result['eid'] = $id;
		$result['lid'] = $lid;
		$result['cname'] = $cts_ftch['name'];
		$result['cid'] = $cid;
		$result['event_id'] = $account['id'];
		$result['location'] = $account['location'];
		$result['type'] = $account['type'];
		$result['created_at'] = date("h:i:s A jS M, Y",strtotime($account['created_at']));
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Oppurtunity doesnot exists';
	}	
}

print json_encode($result);