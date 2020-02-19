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
	$category_name = $_POST['category_name'];

	

	$sql = "INSERT INTO `category` VALUES (NULL,'$category_name',0)";
	$exe = $conn->query($sql);

	if($exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Category Created Successfully';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Category, Try later';
	}
}

print json_encode($result);