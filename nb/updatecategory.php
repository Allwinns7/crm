<?php
include('conn.php');
$id = $_POST['eid'];

$name = $_POST['category_name'];
$status = $_POST['cstatus'];
$eid = $_POST['sid'];

$modified = date('Y-m-d H:i:s');

$update = "UPDATE `category` SET `name`='$name', `status`=$status WHERE id=$eid ";

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