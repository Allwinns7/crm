<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $products_sql = $conn->query("SELECT * FROM `arm_bank` ORDER BY bank_name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Bank transaction</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
   </head>
   <body class="hold-transition sidebar-mini">
      <div id="preloader">
         <div id="status"></div>
      </div>
      <div class="wrapper">
         <?php 
            include('includes/topbar.inc');
            include('includes/sidebar.inc');
         ?> 
         <div class="content-wrapper">
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-usd"></i>
               </div>
               <div class="header-title">
                  <h1>Bank Transaction</h1>
                  <small>Add New Bank Transaction</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                    <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                       <div class="panel-heading">
                          <div class="panel-title">
                             <h4>Bank transaction </h4>
                          </div>
                       </div>
                       <form action="#" class="form-vertical" id="insert_deposit" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                          <div class="panel-body">
                             <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label">Date <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="date" id="date" required="" placeholder="Date" tabindex="1">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="account_type" class="col-sm-3 col-form-label">Account Type <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <select class="form-control" id="account_type" name="account_type" tabindex="2">
                                      <option value="+">Credit (+)</option>
                                      <option value="-">Debit (-)</option>
                                   </select>
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="bank_name" class="col-sm-3 col-form-label">Bank Name <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <select class="form-control" name="bank_id" id="bank_name" tabindex="3">
                                      <option value="">Select Bank</option>
                                      <?php 
                                        while($banks = $products_sql->fetch_assoc()) {
                                          echo "<option value='".$banks['id']."'>".$banks['bank_name']."</option>";
                                        }
                                      ?>
                                   </select>
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">Description <i class="text-danger"></i></label>
                                <div class="col-sm-6">
                                   <textarea class="form-control" placeholder="Description" name="description" id="description" tabindex="4"></textarea>
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="withdraw_deposite_id" class="col-sm-3 col-form-label">Withdraw / Deposite ID <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="withdraw_deposite_id" id="withdraw_deposite_id" required="" placeholder="Withdraw / Deposite ID" tabindex="5" onkeyup="special_character_remove(this.value, 'withdraw_deposite_id')">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="ammount" class="col-sm-3 col-form-label">Amount <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="amount" id="amount" required="" placeholder="Amount" tabindex="6">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-6">
                                   <input type="submit" id="add-deposit" class="btn btn-success custom_btn custom_fontcolor" name="add-deposit" value="Save" tabindex="8">
                                   <input type="reset" class="btn btn-danger" value="Reset" tabindex="7">
                                </div>
                             </div>
                          </div>
                       </form>
                    </div>
                  </div>
               </div>
            </section>
         </div>
         <?php include('includes/footer.inc');?>
      </div>
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/tableExport.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jquery.base64.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/html2canvas.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/sprintf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jspdf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/base64.js" type="text/javascript"></script>
      <script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
        $("#date").datepicker({dateFormat: 'yy-mm-dd'});
        function special_character_remove(vtext, id) {
                var specialChars = "@!#$%^&*()_+[]{}?:;|'`/><";
                var check = function (string) {
                    for (i = 0; i < specialChars.length; i++) {
                        if (string.indexOf(specialChars[i]) > -1) {
                            return true
                        }
                    }
                    return false;
                }
                if (check($('#' + id).val()) == false) {

                } else {
                    alert(specialChars + " these special character are not allows");
                    $("#" + id).val('').focus();

                }
            }

            function onlynumber_allow(vtext, id) {
                var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\/~`-=abcdefghijklmnopqrstuvwxyz"
                var check = function (string) {
                    for (i = 0; i < specialChars.length; i++) {
                        if (string.indexOf(specialChars[i]) > -1) {
                            return true
                        }
                    }
                    return false;
                }
                if (check($('#' + id).val()) == false) {
                } else {
                    alert(specialChars + " these special character are not allows");
                    $("#" + id).val('').focus();
                }
            }
        $('#insert_deposit').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_deposit');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addtransaction.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Bank Transaction Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+result.message+' !</div>');
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
      </script>
   </body>
</html>outofstock