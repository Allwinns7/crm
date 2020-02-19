<?php 
session_start();
include('conn.php');

$result = array();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

$get_crnttkn = $conn->query("SELECT * FROM `users` WHERE `id`=$user");
$tkn_fetch = $get_crnttkn->fetch_assoc();
$saved_token = $tkn_fetch['session'];

if($token==$saved_token) {
	$result['status'] = 'success';
	$result['message'] = 'Authentication Successful';
}
else {
	$result['status'] = 'failed';
	$result['message'] = 'Session Expired';
}
print json_encode($result);