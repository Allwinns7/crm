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
      <title>CRM | Contacts</title>
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
                  <h1>Contacts</h1>
                  <small>Contacts Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Contacts</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal"><i class="fa fa-plus"></i> Add Contact</a>  
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>No.</th>
                                       <th>Name</th>
                                       <th>Account</th>
                                       <th>Phone No</th>
                                       <th>Email</th>
                                       <th>View</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $an=1;
                                       while($all_accounts = $accounts_exe->fetch_assoc()) {
                                          $ac_ids = $all_accounts['acc_id'];
                                          $get_acc_name = "SELECT * FROM `accounts` WHERE id=$ac_ids";
                                          $exe_get_acc = $conn->query($get_acc_name);
                                          $acc_detail = $exe_get_acc->fetch_assoc();
                                          echo '<tr>
                                             <td>
                                                '.$an.'
                                             </td>
                                             <td><a href="javascript:void(0);" onclick="getaccouns('.$all_accounts['id'].')" data-toggle="modal" data-target="#viewsal">'.$all_accounts['name'].'</a></td>
                                             <td>'.$acc_detail['name'].'</td>
                                             <td>'.$all_accounts['phone'].'</td>
                                             <td>'.$all_accounts['email'].'</td>
                                             <td>
                                                <button type="button" onclick="getaccouns('.$all_accounts['id'].')" class="btn btn-add btn-xs" data-toggle="modal" data-target="#viewsal"><i class="fa fa-eye"></i></button>
                                                <button type="button" class="btn btn-danger btn-xs" onclick="accDelete('.$all_accounts['id'].')">
                                                <i class="fa fa-trash-o"></i> 
                                                </button>
                                             </td>
                                          </tr>';
                                          $an++;
                                       }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal left fade" id="addsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Contact Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="newcontact">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Name</label>
                                          <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Account</label>
                                          <select name="acc_id" id="acc_id" class="form-control">
                                             <?php 
                                                while($company_list = $select_acc_exe->fetch_assoc()) {
                                                      echo '<option value="'.$company_list['id'].'">'.$company_list['name'].'</option>';
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Email</label>
                                          <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone Number</label>
                                          <input type="number" name="phone" id="phone" placeholder="Phone Number" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">City</label>
                                          <input type="text" name="city" id="city" placeholder="City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Country</label>
                                          <input type="text" name="country" id="country" placeholder="Country" class="form-control" required="">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="desc" id="desc" placeholder="Description" class="form-control" required="">
                                       </div>
                                       
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-left">
                                             <button type="submit" class="btn btn-add">Add</button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal right fade" id="viewsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Contact Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="col-sm-6">
                                    <h5>Name</h5>
                                    <h6 id="co_name"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Accounts</h5>
                                    <h6 id="co_acc"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Email</h5>
                                    <h6 id="co_mail"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Phone</h5>
                                    <h6 id="co_phone"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>City</h5>
                                    <h6 id="co_city"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Country</h5>
                                    <h6 id="co_country"></h6>
                                 </div>
                                 <div class="col-sm-12">
                                    <h5>Description</h5>
                                    <h6 id="co_desc"></h6>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
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
         $('#newcontact').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('newcontact');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/addcontact.php",
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
                              swal({
                                title: "Success",
                                text: "Contact Created successfully!!!",
                                icon: "success",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                window.location.reload();
                              });
                        }
                        else {
                            swal({
                                title: "Failed",
                                text: "Failed to create contact!!!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                window.location.reload();
                              });
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
         $('#editaccount').submit(function(e){
            e.preventDefault();
            var all_res = document.getElementById('editaccount');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/updateaccount.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        
                        if(result.status=='success') {
                           swal({
                             title: "Success",
                             text: "Account Updated successfully!!!",
                             icon: "success",
                             buttons: true,
                             dangerMode: true,
                           })
                           .then((willDelete) => {
                             window.location.reload();
                           });
                        }
                        else {
                            swal({
                             title: "Failed",
                             text: "Failed to update account details!!",
                             icon: "warning",
                             buttons: true,
                             dangerMode: true,
                           })
                           .then((willDelete) => {
                             window.location.reload();
                           });
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
         function getaccouns(id) {
            $.ajax({
              url: 'backend/getcontacts.php',
              type: 'POST',
              data:{
                  id:id
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  $('#co_name').html(result.name);
                  $('#co_acc').html(result.account);
                  $('#co_mail').html(result.email);
                  $('#co_phone').html(result.phone);
                  $('#co_city').html(result.city);
                  $('#co_country').html(result.country);
                  $('#co_desc').html(result.description);
              },
              error: function(xhr, textStatus, errorThrown) {
                  alert('Network Error, Try Later!!');
                  return false;
              }
            });
         }
         function accDelete(id) {
            swal({
              title: "Are you sure?",
              text: "Do you want to delete this contact !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deletecontact.php',
                    type: 'POST',
                    data:{
                        id:id
                    },
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                           swal({
                             title: "Success",
                             text: "Contact Deleted successfully!!!",
                             icon: "success",
                             buttons: true,
                             dangerMode: true,
                           })
                           .then((willDelete) => {
                             window.location.reload();
                           });
                        }
                        else {
                            swal({
                             title: "Failed",
                             text: "Failed to delete contact details!!",
                             icon: "warning",
                             buttons: true,
                             dangerMode: true,
                           })
                           .then((willDelete) => {
                             window.location.reload();
                           });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Network Error, Try Later!!');
                        return false;
                    }
                  });
              }
            });
         }
      </script>
   </body>
</html>