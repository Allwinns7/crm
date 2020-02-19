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
	$sql = "SELECT * FROM `tbl_products` WHERE id=$id";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		$account = $sql_exe->fetch_assoc();
		$result['status'] = 'success';
		$result['name'] = $account['name'];
		$result['price'] = $account['price'];
		$result['sku'] = $account['sku'];
		$result['id'] = $account['id'];
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Product doesnot exists';
	}	
}

print json_encode($result);