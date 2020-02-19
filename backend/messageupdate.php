<?php
include ('conn.php');
session_start();
$user_id = $_SESSION['user_id'];
$message_update = "UPDATE `messages` SET `read`=0 WHERE `to_id`=$user_id";
$mesqge_sql = $conn->query($message_update);
if($message_sql==TRUE) {
	echo 'Success';
}
else {
	echo 'Failed';
}