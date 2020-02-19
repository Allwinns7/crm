<?php
include('conn.php');
$id = $_POST['eid'];

$name = $_POST['e_name'];
$price = $_POST['eprice'];
$sku = $_POST['esku'];

$update = "UPDATE `tbl_products` SET name='$name', price=$price, sku='$sku' WHERE id=$id ";
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