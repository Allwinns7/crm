<?php
include('conn.php');
$id = $_POST['eid'];

$etitle = $_POST['etitle'];
$eid = $_POST['eid'];
$estart = $_POST['estart'];
$eend = $_POST['eend'];
$elocation = $_POST['elocation'];
$eevent = $_POST['eevent'];
$econtacts = $_POST['econtacts'];
$eleads = $_POST['eleads'];

$modified = date('Y-m-d H:i:s');

$update = "UPDATE `calendar` SET `start`='$estart', `end`='$eend', `message`='$etitle', `location`='$elocation', `type`='$eevent', `contacts`=$econtacts, `leads`=$eleads WHERE id=$eid ";

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