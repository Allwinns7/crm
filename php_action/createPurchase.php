<?php
require_once 'core.php';
$valid['success'] = array(
    'success' => false,
    'messages' => array(),
    'order_id' => ''
);
// print_r($valid);
if ($_POST) {
    $orderDate        = date('Y-m-d', strtotime($_POST['orderDate']));
    $supplier_id       = $_POST['supplier_id'];
    $clientEmail    = $_POST['clientEmail'];
    $subTotalValue    = $_POST['subTotalValue'];
    $vatValue         = $_POST['vatValue'];
    $totalAmountValue = $_POST['totalAmountValue'];
    $discount         = $_POST['discount'];
    $grandTotalValue  = $_POST['grandTotalValue'];
    $paid             = $_POST['paid'];
    $dueValue         = $_POST['dueValue'];
    $paymentType      = $_POST['paymentType'];
    $paymentStatus    = $_POST['paymentStatus'];
    $sql              = "INSERT INTO arm_purchase (order_date, client_name, client_email, client_address, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status) VALUES ('$orderDate', '$supplier_id', '$clientEmail', '', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1)";
    
    $order_id;
    $orderStatus = false;
    if ($connect->query($sql) === true) {
        $order_id          = $connect->insert_id;
        $valid['order_id'] = $order_id;
        $orderStatus       = true;
    }
    // echo $_POST['productName'];
    $orderItemStatus = false;
    for ($x = 0; $x < count($_POST['productName']); $x++) {
        $updateProductQuantitySql  = "SELECT products.quantity FROM products WHERE products.id = " . $_POST['productName'][$x] . "";
        $updateProductQuantityData = $connect->query($updateProductQuantitySql);
        while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
            $updateQuantity[$x] = $updateProductQuantityResult[0] + $_POST['quantity'][$x];
            // update product table
            $updateProductTable = "UPDATE products SET quantity = '" . $updateQuantity[$x] . "' WHERE id = " . $_POST['productName'][$x] . "";
            $connect->query($updateProductTable);
            // add into order_item
            $orderItemSql = "INSERT INTO arm_purchase_item (order_id, product_id, quantity, rate, total, order_item_status) 
VALUES ('$order_id', '" . $_POST['productName'][$x] . "', '" . $_POST['quantity'][$x] . "', '" . $_POST['rateValue'][$x] . "', '" . $_POST['totalValue'][$x] . "', 1)";
            $connect->query($orderItemSql);
            if ($x == count($_POST['productName'])) {
                $orderItemStatus = true;
            }
        } // while    
    } // /for quantity
    $valid['success']  = true;
    $valid['messages'] = "Successfully Added";
    $connect->close();
    echo json_encode($valid);
}