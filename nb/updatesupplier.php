<?php
include('conn.php');
$id = $_POST['eid'];

$name = $_POST['supplier_name'];
$eid = $_POST['sid'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$detail = $_POST['details'];
$balance = $_POST['details'];

$modified = date('Y-m-d H:i:s');

$update = "UPDATE `suppliers` SET `name`='$name', `mobile`='$mobile', `address`='$address', `detail`='$detail', `balance`='$balance' WHERE id=$eid ";

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