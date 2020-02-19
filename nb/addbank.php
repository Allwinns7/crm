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


	$bank_name = $_POST['bank_name'];
	$currency = $_POST['currency'];
	$ac_name = $_POST['ac_name'];
	$ac_no = $_POST['ac_no'];
	$branch = $_POST['branch'];
	$balance = $_POST['balance'];
	$check_sku = "SELECT * FROM `arm_bank` WHERE bank_name='$bank_name' AND ac_name='$ac_name' AND ac_no='$ac_no'";
	$sku_sql = $conn->query($check_sku);
	$cku_count = mysqli_num_rows($sku_sql);

	$result = array();

	if($cku_count>0) {

		$result['status'] = 'failed';
		$result['message'] = 'Bank already exist';

	}
	else {
		
		$sql = "INSERT INTO `arm_bank` VALUES (NULL,'$bank_name', '$currency', '$ac_name', '$ac_no', '$branch', '$balance')";
		$exe = $conn->query($sql);

		$ins_id = $conn->insert_id;

		if($exe==TRUE) {

			$trans_date = date('Y-m-d');
			$expense_sql = "INSERT INTO `arm_bank_transaction` VALUES (NULL,$ins_id, '$trans_date', 'Account Opening Balance', 'NA', '$balance', '0', '$balance')";
			$expense_exe = $conn->query($expense_sql);
			$result['status'] = 'success';
			$result['message'] = 'Bank Added Successfully';
		}
		else {
			$result['status'] = 'failed';
			$result['message'] = 'Failed to add Bank, Try later';
		}

	}

	

}

print json_encode($result);