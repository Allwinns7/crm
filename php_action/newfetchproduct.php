<?php 	

require_once 'core.php';

$sql = "SELECT id, name FROM products ORDER BY name ASC";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);