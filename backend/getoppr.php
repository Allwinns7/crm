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
	$sql = "SELECT * FROM `oppurtunity` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$cmp_id = $account['account_id'];
		$com_det = "SELECT * FROM `accounts` WHERE `id`=$cmp_id";
		$com_exe = $conn->query($com_det);
		$com_fet = $com_exe->fetch_assoc();

		$cnt_id = $account['contact_id'];
		$cnt_det = "SELECT * FROM `contacts` WHERE `id`=$cnt_id";
		$cnt_exe = $conn->query($cnt_det);
		$cnt_fet = $cnt_exe->fetch_assoc();

		$result['status'] = 'success';
		$result['name'] = $account['name'];
		$result['account'] = $com_fet['name'];
		$result['account_id'] = $cmp_id;
		$result['contact_id'] = $cnt_id;
		$result['stage'] = $account['stage'];
		$result['amount'] = $account['amount'];
		$result['propabality'] = $account['propability'];
		$result['close_date'] = $account['close_date'];
		$result['contact'] = $cnt_fet['name'];
		$result['source'] = $account['source'];
		$result['desc'] = $account['desc'];
		$result['created_at'] = date("h:i:s A jS M, Y",strtotime($account['created_at']));
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Oppurtunity doesnot exists';
	}	
}

print json_encode($result);