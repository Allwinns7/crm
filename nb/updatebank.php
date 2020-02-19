<?php
include('conn.php');

$bank_name = $_POST['bank_name'];
$ac_name = $_POST['ac_name'];
$ac_no = $_POST['ac_no'];
$branch = $_POST['branch'];
$balance = $_POST['balance'];

$id = $_POST['id'];


$update = "UPDATE `arm_bank` SET `bank_name`='$bank_name', `ac_name`='$ac_name', `ac_no`='$ac_no', `branch`='$branch', `balance`='$balance' WHERE id=$id ";

$update_exe = $conn->query($update);

$result = array();

if($update_exe==TRUE){
	$result['status'] = 'success';
	$result['message'] = 'Updated Successfully';
}
else {
	$result['status'] = 'failed';
	$result['message'] = 'Failed to Update Data';
}

print json_encode($result);