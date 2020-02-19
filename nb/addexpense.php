<?php
include('conn.php');
session_start();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

if($user==''||$token=='') {
	$result['status'] = 'failed';
	$result['message'] = 'Unauthorized access';
}
else {


	$date = $_POST['date'];
	$expense = $_POST['expense'];
	$paytype = $_POST['paytype'];
	$bill_no = $_POST['bill_no'];
	$bank = $_POST['bank'];
	$amount = $_POST['amount'];
	$record_time = date('Y-m-d H:i:s');

	if($paytype==1) {

		$sql = "INSERT INTO `arm_expense` VALUES (NULL,'$date', '$expense', 'Cash Payment', '$bill_no', '$amount', $user, '$record_time')";
		$exe = $conn->query($sql);

		if($exe==TRUE) {
			$result['status'] = 'success';
			$result['message'] = ' Added Successfully';
		}
		else {
			$result['status'] = 'failed';
			$result['message'] = 'Failed to add expense, Try later';
		}

	}
	else {

		$sql = "INSERT INTO `arm_expense` VALUES (NULL,'$date', '$expense', 'Bank Payment', '$bank', '$amount', $user, '$record_time')";
		$exe = $conn->query($sql);

		if($exe==TRUE) {

				$get_old_bal = $conn->query("SELECT * FROM arm_bank WHERE id=$bank");
				$fetch_bank = $get_old_bal->fetch_assoc();
				$old_bal = $fetch_bank['balance'];
				$new_bal = $old_bal-$amount;

			   $exe = $conn->query("INSERT INTO `arm_bank_transaction` VALUES(NULL, $bank, '$date', 'Expense of $expense', '', 0, '$amount', '$new_bal')");

				if($exe==TRUE) {

					$update_bank = $conn->query("UPDATE `arm_bank` SET balance='$new_bal' WHERE id=$bank");

					$result['status'] = 'success';
					$result['message'] = 'Expense Added Successfully';

				}

		}
		else {
			$result['status'] = 'failed';
			$result['message'] = 'Failed to add expense, Try later';
		}

	}	

}

print json_encode($result);