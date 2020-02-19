<?php
include('conn.php');
session_start();
$user_id=$_SESSION['user_id'];

$password = $_POST['password'];
$datetime = date('Y-m-d H:i:s');
$sql = "UPDATE `users` SET `password`='$password', modified='$datetime' WHERE `id`=$user_id";
$sql_exe = $conn->query($sql);
if($sql_exe==TRUE) {
	echo 'success';
}
else {
	echo 'failed';
}