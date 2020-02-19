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
	$id = $_POST['sid'];
	$sql = "SELECT * FROM `products` WHERE `supplier`=$id";

	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	if($count>0) {
		echo "<option value=''>Select Product</option>";
		while($account = $sql_exe->fetch_assoc()) {
			echo "<option value='".$account['id']."'>".$account['name']."</option>";
		}
	}
	else {
		echo 'Products doesnot exists';
	}	
}