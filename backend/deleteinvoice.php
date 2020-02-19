<?php
$connect = new PDO('mysql:host=localhost;dbname=crm', 'root', 'solution');

$result = array();

$statement = $connect->prepare("DELETE FROM tbl_order WHERE order_id = :id");
$statement->execute(
  array(
    ':id'       =>      $_POST["id"]
  )
);
$statement = $connect->prepare(
  "DELETE FROM tbl_order_item WHERE order_id = :id");
$statement->execute(
  array(
    ':id'       =>      $_POST["id"]
  )
);
$result['status'] = 'success';
$result['message'] = 'Contact Deleted Succcessfully!!';
print json_encode($result);