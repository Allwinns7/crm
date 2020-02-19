<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $sid = $_GET['id'];
   $accounts = $conn->query("SELECT * FROM `arm_bank` WHERE `id`=$sid");
   $accounts_exe = $accounts->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Bank</title>
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
                  <h1>Bank</h1>
                  <small>Edit Bank Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Edit Bank </h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="insert_bank" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                          <div class="panel-body">
                             <div class="form-group row">
                                <label for="bank_name" class="col-sm-3 col-form-label">Bank Name <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                  <input type="hidden" name="id" value="<?php echo $accounts_exe['id'];?>" id="id" >
                                   <input type="text" class="form-control" name="bank_name" value="<?php echo $accounts_exe['bank_name'];?>" id="bank_name" required="" placeholder="Bank Name" tabindex="1" >
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="ac_name" class="col-sm-3 col-form-label">A/C Name <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="ac_name" value="<?php echo $accounts_exe['ac_name'];?>" id="ac_name" required="" placeholder="A/C Name" tabindex="2" >
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="ac_no" class="col-sm-3 col-form-label">A/C Number <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="ac_no" value="<?php echo $accounts_exe['ac_no'];?>" id="ac_no" required="" placeholder="A/C Number" tabindex="3">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="branch" class="col-sm-3 col-form-label">Branch <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="branch" value="<?php echo $accounts_exe['branch'];?>" id="branch" required="" placeholder="Branch" tabindex="4">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="branch" class="col-sm-3 col-form-label">Balance <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <input type="number" class="form-control" name="balance" value="<?php echo $accounts_exe['balance'];?>" id="balance" required="" placeholder="Bank Balance" tabindex="4">
                                </div>
                             </div>
                             <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-6">
                                  <input type="submit" id="add-deposit" class="btn btn-success custom_btn custom_fontcolor" name="add-deposit" value="Update" tabindex="6">
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
                    url:"nb/updatebank.php",
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
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Bank Updated Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Category Failed to Update !</div>');
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