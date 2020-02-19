<?php
session_start();
include('conn.php');

//POST Data
$username = $_POST['username'];
$password = $_POST['password'];

//Query Build
$sql = "SELECT * FROM users WHERE email='$username' AND password='$password'";
$exec = $conn->query($sql);

//get Count of Rows
$row_count = mysqli_num_rows($exec);

//Empty Array
$result = array();


if($row_count==1) {
	$data = $exec->fetch_assoc();
	$token = RandomString();
	$user_id = $data['id'];
	updateToken($token,$user_id);
	$result['status'] = 'success';
	$result['message'] = 'Successfull attempt';
	$result['token'] = $token;

	$_SESSION['user_id'] = $user_id;
	$_SESSION['token'] = $token;
}

else {
	$result['status'] = 'failed';
	$result['message'] = 'Invalid Username or Password';
}

print json_encode($result);


//Generate random token for current user
function RandomString(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

//Update authentication token in database
function updateToken($token,$uid) {
	include('conn.php');
	$result = array();
	$auth_token = $token;
	$user_id = $uid;
	$datetime = date('Y-m-d H:i:s');
	$sql = "UPDATE users SET session='$auth_token', last_login='$datetime' WHERE id=$user_id";
	$exec = $conn->query($sql);
}