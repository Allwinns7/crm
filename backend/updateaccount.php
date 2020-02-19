<?php
include('conn.php');
$id = $_POST['eid'];

$acc_name = $_POST['eacc_name'];
$email = $_POST['eemail'];
$acc_own = $_POST['eacc_own'];
$etype = $_POST['etype'];
$ewebsite = $_POST['ewebsite'];
$ephone = $_POST['ephone'];
$edesc = $_POST['edesc'];
$eindustry = $_POST['eindustry'];
$eemps = $_POST['eemps'];
$ebaddress = $_POST['ebaddress'];
$ebstreet = $_POST['ebstreet'];
$ebcity = $_POST['ebcity'];
$ebstate = $_POST['ebstate'];
$ebzip = $_POST['ebzip'];
$ebcountry = $_POST['ebcountry'];
$esaddress = $_POST['esaddress'];
$esstreet = $_POST['esstreet'];
$escity = $_POST['escity'];
$esstate = $_POST['esstate'];
$eszip = $_POST['eszip'];
$escountry = $_POST['escountry'];
$modified = date('Y-m-d H:i:s');

$update = "UPDATE `accounts` SET name='$acc_name', owner='$acc_own', type='$etype', email='$email', website='$ewebsite', phone='$ephone', description='$edesc', industry='$eindustry', employees=$eemps, baddress='$ebaddress', bstreet='$ebstreet', bcity='$ebcity', bstate='$ebstate', bzip='$ebzip', bcountry='$ebcountry', saddress='$esaddress', sstreet='$esstreet', scity='$escity', sstate='$esstate', szip='$eszip', scountry='$escountry', modified_at='$modified' WHERE id=$id ";
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