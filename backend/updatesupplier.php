<?php
include('conn.php');
$id = $_POST['eacc_id'];

$acc_name = $_POST['eacc_name'];
$email = $_POST['eemail'];
$ephone = $_POST['ephone'];
$ebaddress = $_POST['eaddress'];
$ebstreet = $_POST['estreet'];
$ebcity = $_POST['ecity'];
$ebstate = $_POST['estate'];
$ebzip = $_POST['ezip'];
$ebcountry = $_POST['ecountry'];
$modified = date('Y-m-d H:i:s');

$update = "UPDATE `arm_suppliers` SET name='$acc_name', email='$email', phone='$ephone', address='$ebaddress', street='$ebstreet', city='$ebcity', state='$ebstate', zip='$ebzip', country='$ebcountry', modified_at='$modified' WHERE id=$id ";
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