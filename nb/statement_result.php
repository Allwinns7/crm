<?php
include('conn.php');
session_start();

$user = $_SESSION['user_id'];
$token = $_SESSION['token'];

$results = '';

if($user==''||$token=='') {
	$results = 'Unauthorized access';
}
else {
	$from_date = $_POST['from_date'];
	$end_date = $_POST['end_date'];

	$sql = "SELECT * FROM `arm_expense` WHERE `date`>='$from_date' AND `date` <='$end_date' ";
	$sql_exe = $conn->query($sql);
	$count = mysqli_num_rows($sql_exe);

	$result = array();

	$results .= '<div class="row">
    <div class="col-sm-12">        
        <div class="m-b-10">
            <a  class="btn btn-success" href="#" onclick="printDiv(purchase_div)"><i class="fa fa-print"></i></a>
        </div>        
        <div class="panel panel-bd lobidrag" id="printArea">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>Expense Statement </h4>
                </div>
            </div>
            <div class="panel-body">        
                <div id="loaded_img" style="display: none; text-align: center; "><img src="https://wholesalenew.bdtask.com/newholesale/assets/dist/img/loader.gif" alt="" width="2%" style="position: fixed; left: 55%; top: 70%; z-index: 999;"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="expenselist">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Date</th>
                                <th>Expense Item</th>
		                        <th>Payment Type</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>';

	if($count>0) {

		$cnt=1;
		while($account = $sql_exe->fetch_assoc()) {
			$results .= '<tr>
                            <td>'.$cnt.'</td>
                            <td>'.$account['date'].'</td>
                            <td>'.$account['item'].'</td>
                            <td>'.$account['ptype'].'</td>
                            <td class="text-right">
                                $'.$account['amount'].'
                            </td>
                        </tr>'; 
            $cnt++;
		}
		$results .='</tbody></table>
				    </div>
				    </div>
				    </div>
				    </div>
					</div>
					<script type="text/javascript">
				    function printDiv() {
				        var divName = "printArea";
				        var printContents = document.getElementById(divName).innerHTML;
				        var originalContents = document.body.innerHTML;
				        document.body.innerHTML = printContents;
				        window.print();
				        document.body.innerHTML = originalContents;
				        window.location.reload(true);
				    }
					</script>';
	}
	else {
		$results .='<tr><td colspan="5" style="text-align:center">No records exist</td></tr></tbody></table>
				    </div>
				    </div>
				    </div>
				    </div>
					</div>
					<script type="text/javascript">
				    function printDiv() {
				        var divName = "printArea";
				        var printContents = document.getElementById(divName).innerHTML;
				        var originalContents = document.body.innerHTML;
				        document.body.innerHTML = printContents;
				        window.print();
				        document.body.innerHTML = originalContents;
				        window.location.reload(true);
				    }
					</script>';
	}	
}

print ($results);