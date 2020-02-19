<?php
include ('conn.php');
session_start();
$user_id = $_SESSION['user_id'];
$message_update = "UPDATE `notifications` SET `read`=0 WHERE `user_id`=$user_id";
$mesqge_sql = $conn->query($message_update);
if($message_sql==TRUE) {
	echo 'Success';
}
else {
	echo 'Failed';
}