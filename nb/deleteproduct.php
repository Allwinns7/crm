<?php
include('conn.php');
$id = $_POST['supplier_id'];
session_start();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

$result = array();

if($user==''||$token=='') {
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
}
else {
	$sql = "DELETE FROM `products` WHERE `id`=$id ";
	$sql_exe = $conn->query($sql);
	if($sql_exe==TRUE) {
		$result['status'] = 'success';
		$result['message'] = 'Product Deleted Succcessfully!!';
	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to delete!!';
	}

}
print json_encode($result);