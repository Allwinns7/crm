<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $banks_sql = $conn->query("SELECT * FROM `arm_bank` ORDER BY bank_name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Add Expense</title>
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
                  <h1>Bank Details</h1>
                  <small>Add New Bank</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                    <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                       <div class="panel-heading">
                          <div class="panel-title">
                             <h4>
                                Add Expense   
                             </h4>
                          </div>
                       </div>
                       <div class="panel-body">
                          <div class="row">
                             <form action="#" id="expense_add" method="post">
                                <div class="col-sm-12">
                                   <div class="form-group row">
                                      <label for="date" class="col-sm-3 col-form-label text-right">Date<i class="text-danger">*</i>
                                      </label>
                                      <div class="col-sm-8">
                                         <input type="text" name="date" id="date" class="form-control">
                                      </div>
                                   </div>
                                </div>
                                <div class="col-sm-12" id="payment_from_1">
                                   <div class="form-group row">
                                      <label for="expense_type" class="col-sm-3 col-form-label text-right">Expense Item <i class="text-danger">*</i></label>
                                      <div class="col-sm-8">
                                         <input type="text" name="expense" id="expense" class="form-control" required="">
                                      </div>
                                   </div>
                                </div>
                                <div class="col-sm-12" id="payment_from_1">
                                   <div class="form-group row">
                                       <label for="payment_type" class="col-sm-3 col-form-label text-right">Payment Type <i class="text-danger">*</i></label>
                                       <div class="col-sm-8">
                                           <select name="paytype" class="form-control" required="" id="paytype" onchange="bank_paymet(this.value)" required="">
                                               <option value="">Select Payment Option</option>
                                               <option value="1">Cash Payment</option>
                                               <option value="2">Bank Payment</option>
                                           </select>
                                       </div>
                                   </div>
                                </div>
                                <div class="col-sm-12" id="wbank" style="display: none">
                                   <div class="form-group row">
                                       <label for="payment_type" class="col-sm-3 col-form-label text-right">Select Bank<i class="text-danger">*</i></label>
                                       <div class="col-sm-8">
                                           <select name="bank" class="form-control" id="bank" onchange="bank_paymet(this.value)">
                                               <option value="">Select Bank</option>
                                               <?php 
                                               while($banks = $banks_sql->fetch_assoc()) {
                                                  echo "<option value='".$banks['id']."'>".$banks['bank_name']."</option>";
                                               }
                                               ?>
                                           </select>
                                       </div>
                                   </div>
                                </div>
                                <div class="col-sm-12" id="bill" style="display: none">
                                   <div class="form-group row">
                                      <label for="expense_type" class="col-sm-3 col-form-label text-right">Bill No<i class="text-danger">*</i></label>
                                      <div class="col-sm-8">
                                         <input type="text" name="bill_no" id="bill_no" class="form-control">
                                      </div>
                                   </div>
                                </div>
                                <div class="col-sm-12" id="payment_from_1">
                                   <div class="form-group row">
                                      <label for="amount" class="col-sm-3 col-form-label text-right">Amount<i class="text-danger">*</i></label>
                                      <div class="col-sm-8">
                                         <input type="number" name="amount" id="amount" class="form-control" required="">
                                      </div>
                                   </div>
                                </div>
                                <div class="form-group row">
                                   <div class="col-sm-12 text-center">
                                      <input type="submit" id="add_receive" class="btn custom_btn custom_fontcolor btn-large" name="save" value="Save" tabindex="9">
                                   </div>
                                </div>
                             </form>
                          </div>
                       </div>
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
        function bank_paymet(val){
          if(val==1){
             $('#bill').show();
             $('#wbank').hide();
             $('#bill_no').prop('required',true);
             $('#wbank').prop('required',false);
          }
          else if(val==2) {
              $('#bill').hide();
              $('#wbank').show();
              $('#bill_no').prop('required',false);
              $('#wbank').prop('required',true);
          }
          else {
              $('#bill').hide();
              $('#wbank').hide();
              $('#bill_no').prop('required',false);
              $('#wbank').prop('required',false);
          }
        }
        $('#expense_add').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('expense_add');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addexpense.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Expense Added Successfully!</div>');
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