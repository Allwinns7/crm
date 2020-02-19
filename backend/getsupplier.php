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
	$sql = "SELECT * FROM `arm_suppliers` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$result['status'] = 'success';
		$result['name'] = $account['name'];
		$result['email'] = $account['email'];
		$result['phone'] = $account['phone'];
		$result['address'] = $account['address'];
		$result['street'] = $account['street'];
		$result['city'] = $account['city'];
		$result['state'] = $account['state'];
		$result['zip'] = $account['zip'];
		$result['country'] = $account['country'];
		$result['id'] = $account['id'];
		$result['joined'] = date("h:i:s A jS M, Y",strtotime($account['created_at']));
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Supplier doesnot exists';
	}	
}

print json_encode($result);