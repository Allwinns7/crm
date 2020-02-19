<?php
include('conn.php');
$email = $_POST['email'];
$sql = "SELECT * FROM `users` WHERE `email`='$email'";
$sql_exe = $conn->query($sql);
$count = mysqli_num_rows($sql_exe);

if($count==1) {
	$data = $sql_exe->fetch_assoc();
	$user_email = $data['email'];
	
	$to = $user_email;
	$auth_token = RandomString();
    $subject = "Password Reset Request from CRM";
    $htmlContent = 'Click below link to reset your password.<br/> <button style="text-align: center;margin: 0;padding: 12px 24px;background: #2224e3;color: #ffffff;text-decoration: none;display: block;border-radius: 5px;" target="_blank" onclick="window.location.href="https://google.com"">Reset</button>';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: CRM Dashboard<noreply@ns7eportal.in>' . "\r\n";

    mail($to,$subject,$htmlContent,$headers);
    echo 'success';
}
else {
	echo 'Account doesnot exist';
}

function RandomString(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 32; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}