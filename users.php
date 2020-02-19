<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $accounts = "SELECT * FROM `emps` ORDER BY username ASC";
   $accounts_exe = $conn->query($accounts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Users</title>
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
                  <h1>Users</h1>
                  <small>User Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>User</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal"><i class="fa fa-plus"></i> Add User</a>  
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>No.</th>
                                       <th>User Name</th>
                                       <th>Email</th>
                                       <th>Phone No</th>
                                       <th>User Type</th>
                                       <th>Created Time</th>
                                       <th>Last Login</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $an=1;
                                       while($all_accounts = $accounts_exe->fetch_assoc()) {
                                          
                                          echo '<tr>
                                             <td>
                                                '.$an.'
                                             </td>
                                             <td><a href="javascript:void(0);" onclick="getaccouns('.$all_accounts['id'].')" data-toggle="modal" data-target="#viewsal">'.$all_accounts['username'].'</a></td>
                                             <td>'.$all_accounts['email'].'</td>
                                             <td>'.$all_accounts['phone'].'</td>
                                             <td>'.$all_accounts['type'].'</td>
                                             <td>'.date("h:i:s A jS M, Y",strtotime($all_accounts['created_time'])).'</td>
                                             <td>'.date("h:i:s A jS M, Y",strtotime($all_accounts['last_login'])).'</td>
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
                           <h3>User Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="newcontact">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">User Name</label>
                                          <input type="text" name="uname" id="uname" placeholder="User Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-8 form-group">
                                          <label class="control-label">Password</label>
                                          <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required="">
                                       </div>
                                       <div class="col-md-4 form-group">
                                          <label class="control-label">&nbsp;</label>
                                           <button type="button" class="btn btn-add" onclick="generatePassword()">Generate Password</button>
                                           <p id="gpassword"></p>
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" name="fname" id="fname" placeholder="Enter First Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Email</label>
                                          <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone</label>
                                          <input type="number" name="phone" id="phone" placeholder="Phone Number" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Gender</label>
                                          <select name="gender" id="gender" class="form-control">
                                             <option value="Male">Male</option>
                                             <option value="Female">Female</option>
                                             <option value="Custom">Custom</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">User Type</label>
                                          <select name="acc_type" id="acc_type" class="form-control">
                                             <option value="Regular">Regular</option>
                                             <option value="Admin">Admin</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Is Active ?</label>
                                          <input type="checkbox" name="active" id="active">
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
                           <h3>User Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="col-sm-6">
                                    <h5>User Name</h5>
                                    <h6 id="unm"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Password</h5>
                                    <h6 id="pwd"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>First Name</h5>
                                    <h6 id="fnm"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Last Name</h5>
                                    <h6 id="lnm"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Email</h5>
                                    <h6 id="emil"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Phone</h5>
                                    <h6 id="phne"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Gender</h5>
                                    <h6 id="gndr"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Account Type</h5>
                                    <h6 id="actp"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Account Status</h5>
                                    <h6 id="acst"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Created Time</h5>
                                    <h6 id="ctime"></h6>
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
         function generatePassword() {

          var result = '';

             var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';

             for (var i = 8; i > 0; --i) 
               result += chars[Math.floor(Math.random() * chars.length)];
               $('#gpassword').html('Generated Password  : '+result);
               $('#password').val(result);
             return result;
         }
         
         $('#newcontact').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('newcontact');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/adduser.php",
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
                                text: "User Created successfully!!!",
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
                                text: "Failed to create user!!!",
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
              url: 'backend/getuser.php',
              type: 'POST',
              data:{
                  id:id
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  $('#unm').html(result.username);
                  $('#pwd').html(result.password);
                  $('#fnm').html(result.fname);
                  $('#lnm').html(result.lname);
                  $('#emil').html(result.email);
                  $('#phne').html(result.phone);
                  $('#gndr').html(result.gender);
                  $('#actp').html(result.utype);
                  $('#acst').html(result.acstatus);
                  $('#ctime').html(result.created_time);
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
              text: "Do you want to delete this user !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deleteuser.php',
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
                             text: "User Deleted successfully!!!",
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
                             text: "Failed to delete user details!!",
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