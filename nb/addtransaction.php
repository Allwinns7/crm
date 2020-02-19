<?php
include('conn.php');
session_start();

$result = array();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

if($user==''||$token=='') 
	{
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
	}
else 
	{

	$date = $_POST['date'];
	$account_type = $_POST['account_type'];
	$bank_id = $_POST['bank_id'];
	$description = $_POST['description'];
	$withdraw_deposite_id = $_POST['withdraw_deposite_id'];
	$amount = $_POST['amount'];


	$get_old_bal = $conn->query("SELECT * FROM arm_bank WHERE id=$bank_id");
	$fetch_bank = $get_old_bal->fetch_assoc();
	$old_bal = $fetch_bank['balance'];

	if($account_type=='+') {
		$new_bal=$old_bal+$amount;
		$credit = $amount;
		$debit = '0';
	}
	else {
		$credit = '0';
		$debit = $amount;
		$new_bal=$old_bal-$amount;
	}	

	$exe = $conn->query("INSERT INTO `arm_bank_transaction` VALUES(NULL, $bank_id, '$date', '$description', '$withdraw_deposite_id', '$credit', '$debit', '$new_bal')");

	if($exe==TRUE) {

		$update_bank = $conn->query("UPDATE `arm_bank` SET balance='$new_bal' WHERE id=$bank_id");

		$result['status'] = 'success';
		$result['message'] = 'Transaction Created Successfully';

	}
	else {
		$result['status'] = 'failed';
		$result['message'] = 'Failed to create Category, Try later';
	}


	}
print_r(json_encode($result));