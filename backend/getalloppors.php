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
	$id = $_POST['id'];
	$sql = "SELECT * FROM `oppurtunity` ORDER BY name ASC LIMIT 5";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	if($count>0) {
		while($account = $sql_exe->fetch_assoc()) {
			$row_array['status'] = 'success';
			$row_array['name'] = $account['name'];
			$row_array['stage'] = $account['stage'];
			$row_array['source'] = $account['source'];

			array_push($result,$row_array);  

		}
	}
	else {
		$result['status'] = 'failure';
		$result['message'] = 'Opportunities doesnot exists';
	}	
}

print json_encode($result);