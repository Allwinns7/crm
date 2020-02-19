<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $accounts = "SELECT * FROM `contacts` ORDER BY name ASC";
   $accounts_exe = $conn->query($accounts);

   $select_account = "SELECT * FROM `accounts` ORDER BY `name` ASC";
   $select_acc_exe = $conn->query($select_account);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Suppliers</title>
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
      <style>
         .modal.right .modal-dialog,
         .modal.left .modal-dialog {
      position: fixed;
      margin: auto;
      width: 600px;
      height: 100%;
      -webkit-transform: translate3d(0%, 0, 0);
          -ms-transform: translate3d(0%, 0, 0);
           -o-transform: translate3d(0%, 0, 0);
              transform: translate3d(0%, 0, 0);
   }

   .modal.right .modal-content,
   .modal.left .modal-content {
      height: 100%;
      background: #ececec;
      overflow-y: auto;
}
   .modal.right .modal-body,
   .modal.left .modal-body {
      padding: 15px 15px 80px;
      background: #fff;
   }

        
/*Right*/
   .modal.right.fade .modal-dialog,
   .modal.left.fade .modal-dialog {
      right: -320px;
      -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
         -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
           -o-transition: opacity 0.3s linear, right 0.3s ease-out;
              transition: opacity 0.3s linear, right 0.3s ease-out;
   }
   
   .modal.right.fade.in .modal-dialog,
   .modal.left.fade.in .modal-dialog {
      right: 0;
   }
   .modal-footer{
      background: #fff;
   }
      </style>
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
                  <h1>Supplier</h1>
                  <small>Add Supplier Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add Supplier </h4>
                           </div>
                        </div>
                        <form action="#" id="insert_supplier" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label for="supplier_name" class="col-sm-3 col-form-label text-right">Supplier Name <i class="text-danger">*</i></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" name="supplier_name" id="supplier_name" type="text" placeholder="Supplier Name" required="" tabindex="1" onkeyup="special_character_remove(this.value, 'supplier_name')">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="mobile" class="col-sm-3 col-form-label text-right">Supplier Mobile <i class="text-danger">*</i></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Supplier Mobile" required="" min="0" tabindex="2" onkeyup="onlynumber_allow(this.value,'mobile')">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="address " class="col-sm-3 col-form-label text-right">Supplier Address</label>
                                 <div class="col-sm-6">
                                    <textarea class="form-control" name="address" id="address " rows="3" placeholder="Supplier Address" tabindex="3"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="details" class="col-sm-3 col-form-label text-right">Supplier Details</label>
                                 <div class="col-sm-6">
                                    <textarea class="form-control" name="details" id="details" rows="3" placeholder="Supplier Details" tabindex="4"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="previous_balance" class="col-sm-3 col-form-label text-right">Previous Balance</label>
                                 <div class="col-sm-6">
                                    <input class="form-control" name="previous_balance" id="previous_balance" placeholder="Previous Balance" tabindex="5" type="number">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-supplier" class="btn custom_btn custom_fontcolor btn-large" name="add-supplier" value="Save" tabindex="6">
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
         function special_character_remove(vtext, id) {
//                var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\/~`-=";
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
                    // Code that needs to execute when none of the above is in the string
                } else {
                    alert(specialChars + " these special character are not allows");
                    $("#" + id).val('').focus();
//            $("#customer_name").focus();
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
                    // Code that needs to execute when none of the above is in the string
                } else {
                    alert("Special character are not allowed");
                    $("#" + id).val('').focus();
                }
            }
         $('#insert_supplier').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_supplier');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addsupplier.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        console.log(result);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Supplier Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Suppliers Failed to Add !</div>');
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
      </script>
   </body>
</html>