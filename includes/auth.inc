<?php
session_start();
if($_SESSION['user_id']==''||$_SESSION['token']=='') {
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header('location:login.php?redirect_uri='.$actual_link);
}
?>