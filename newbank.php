<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $products_sql = $conn->query("SELECT * FROM `products` ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Add New Bank</title>
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
                             <h4>Add New Bank </h4>
                          </div>
                       </div>
                       <form action="#" class="form-vertical" id="insert_bank" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                          <div class="panel-body">
                             <div class="form-group row">
                                <label for="bank_name" class="col-sm-3 col-form-label">Bank Name <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="bank_name" id="bank_name" required="" placeholder="Bank Name" tabindex="1" onkeyup="special_character_remove(this.value, 'bank_name')">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="bank_name" class="col-sm-3 col-form-label">Currency <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                  <select class="form-control" id="currency" name="currency" tabindex="3">
                                    <option value="">Select Currency</option>
                                    <option value="AED">AED (&#1583;.&#1573;)</option>
                                    <option value="INR">INR (&#8377;)</option>
                                    <option value="USD">USD (&#36;)</option>
                                  </select>
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="ac_name" class="col-sm-3 col-form-label">A/C Name <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="ac_name" id="ac_name" required="" placeholder="A/C Name" tabindex="2" onkeyup="special_character_remove(this.value, 'ac_name')">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="ac_no" class="col-sm-3 col-form-label">A/C Number <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="ac_no" id="ac_no" required="" placeholder="A/C Number" tabindex="3">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="branch" class="col-sm-3 col-form-label">Branch <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="branch" id="branch" required="" placeholder="Branch" tabindex="4">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="branch" class="col-sm-3 col-form-label">Balance <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="number" class="form-control" name="balance" id="balance" required="" placeholder="Bank Balance" tabindex="4">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-6">
                                  <input type="submit" id="add-deposit" class="btn btn-success custom_btn custom_fontcolor" name="add-deposit" value="Save" tabindex="6">
                                   <input type="reset" class="btn btn-danger" value="Reset">
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
        $('#insert_bank').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_bank');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addbank.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Bank Added Successfully!</div>');
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