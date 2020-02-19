<?php
include('conn.php');
$id = $_POST['eid'];

$efname = $_POST['efname'];
$elname = $_POST['elname'];
$eacname = $_POST['eacname'];
$eemail = $_POST['eemail'];
$ephone = $_POST['ephone'];
$etitle = $_POST['etitle'];
$ewebsite = $_POST['ewebsite'];
$estreet = $_POST['estreet'];
$ecity = $_POST['ecity'];
$estate = $_POST['estate'];
$ezip = $_POST['ezip'];
$ecountry = $_POST['ecountry'];
$elstatus = $_POST['elstatus'];
$esource = $_POST['esource'];
$eoppr = $_POST['eoppr'];
$eindustry = $_POST['eindustry'];
$edesc = $_POST['edesc'];
$eid = $_POST['eid'];
$assigned_to = $_POST['eassigned_to'];

$modified = date('Y-m-d H:i:s');

$update = "UPDATE `leads` SET fname='$efname', lname='$elname', acc='$eacname', email='$eemail', phone='$ephone', title='$etitle', website='$ewebsite', street='$estreet', city='$ecity', state='$estate', zip='$ezip', country='$ecountry', status='$elstatus', source='$esource', opp='$eoppr', industry='$eindustry', `desc`='$edesc', assigned_to=$assigned_to WHERE id=$eid ";

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