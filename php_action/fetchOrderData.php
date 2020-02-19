<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$sql = "SELECT arm_sales.order_id, arm_sales.order_date, arm_sales.client_name, arm_sales.client_email, arm_sales.sub_total, arm_sales.vat, arm_sales.total_amount, arm_sales.discount, arm_sales.grand_total, arm_sales.paid, arm_sales.due, arm_sales.payment_type, arm_sales.payment_status FROM arm_sales 	
	WHERE arm_sales.order_id = {$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['order'] = $data;


$connect->close();

echo json_encode($valid);