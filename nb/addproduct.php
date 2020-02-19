<?php
include('conn.php');
session_start();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

$result = array();

if($user==''||$token=='') {
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
}
else {


	$sku_code = $_POST['sku_code'];
	$product_name = $_POST['product_name'];
	$category_id = $_POST['category_id'];
	$description = $_POST['description'];
	$cartoon_quantity = $_POST['cartoon_quantity'];
	$price = $_POST['price'];
	$supplier_price = $_POST['supplier_price'];
	$supplier_id = $_POST['supplier_id'];

	$check_sku = "SELECT * FROM `products` WHERE sku='$sku_code'";
	$sku_sql = $conn->query($check_sku);
	$cku_count = mysqli_num_rows($sku_sql);


	if($cku_count>0) {

		$result['status'] = 'failed';
		$result['message'] = 'Product already exist in this SKU Code';

	}
	else {
		
		$sql = "INSERT INTO `products` VALUES (NULL,'$sku_code', '$product_name', '$description', $category_id, $cartoon_quantity, '$supplier_price', '$price', $supplier_id)";
		$exe = $conn->query($sql);

		if($exe==TRUE) {	
			$last_id = $conn->insert_id;
			$update_product = $conn->query("INSERT INTO `arm_purchase_item` VALUES(0,0, $last_id, '$cartoon_quantity', '', '', '')");

			$result['status'] = 'success';
			$result['message'] = 'Product Created Successfully';
		}
		else {
			$result['status'] = 'failed';
			$result['message'] = 'Failed to create Product, Try later';
		}

	}

	

}

print json_encode($result);