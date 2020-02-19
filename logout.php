<?php
session_start();
include("backend/conn.php");

$user_id = $_SESSION['user_id'];
$sql = "UPDATE users SET session='' WHERE id=$user_id";
$exec = $conn->query($sql);

unset($_SESSION['user_id']);
unset($_SESSION['token']);
session_destroy();
header('location:login.php');
?>