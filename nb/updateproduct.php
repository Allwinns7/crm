<?php
include('conn.php');
$id = $_POST['eid'];

$sku_code = $_POST['sku_code'];
$product_name = $_POST['product_name'];
$category_id = $_POST['category_id'];
$description = $_POST['description'];
$cartoon_quantity = $_POST['cartoon_quantity'];
$price = $_POST['price'];
$supplier_price = $_POST['supplier_price'];
$supplier_id = $_POST['supplier_id'];


$update = "UPDATE `products` SET `sku`='$sku_code', `name`='$product_name', `detail`='$description', `category`=$category_id, `quantity`=$cartoon_quantity, `supplier_price`= '$supplier_price', `sell_price`= '$price', `supplier`=$supplier_id WHERE id=$id ";

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