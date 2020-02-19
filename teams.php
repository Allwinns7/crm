<?php
   include('backend/conn.php');
   $sql = "SELECT * FROM `emps` WHERE `team`=0 ORDER BY username ASC";
   $exec = $conn->query($sql);
   
   $group = "SELECT * FROM `teams` ORDER BY name ASC";
   $exec_group = $conn->query($group);
   $group_table = $conn->query($group);
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM - Team Manage</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <style>.address-bar{line-height: 17px;}   .modal.right .modal-dialog {
         position: fixed;
         margin: auto;
         width: 600px;
         height: 100%;
         -webkit-transform: translate3d(0%, 0, 0);
         -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
         transform: translate3d(0%, 0, 0);
         }
         .modal.right .modal-content {
         height: 100%;
         background: #ececec;
         overflow-y: auto;
         }
         .modal.right .modal-body {
         padding: 15px 15px 80px;
         background: #fff;
         }
         /*Right*/
         .modal.right.fade .modal-dialog {
         right: -320px;
         -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
         -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
         -o-transition: opacity 0.3s linear, right 0.3s ease-out;
         transition: opacity 0.3s linear, right 0.3s ease-out;
         }
         .modal.right.fade.in .modal-dialog {
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
                  <i class="fa fa-area-chart"></i>
               </div>
               <div class="header-title">
                  <h1>Team Manage</h1>
                  <small>Full Team Manage</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-6 col-md-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Create New Team</h4>
                              <h5></h5>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form id="newgroup" method="POST">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Team Name</label>
                                 <input type="text" class="form-control" id="groupname" name="groupname" placeholder="Enter Team Name" required="">
                              </div>
                              <button type="submit" class="btn btn-primary">Create</button><br><br><br><br>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Assign Users To Team</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form id="assignroup" method="POST">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Team Name</label>
                                 <select class="form-control" name="groupid" id="groupid">
                                    <?php 
                                       while($data_group = $exec_group->fetch_assoc()){ ?>
                                    <option value="<?php echo $data_group['id'];?>"><?php echo $data_group['name'];?></option>
                                    <?php
                                       } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Unalloted Users</label>
                                 <select class="form-control" id="userid" name="userid">
                                    <?php 
                                       while($data = $exec->fetch_assoc()){ ?>
                                    <option value="<?php echo $data['id'];?>"><?php echo $data['username'];?></option>
                                    <?php
                                       } ?>
                                 </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Allot</button>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>All Teams</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <?php 
                              while($all_groups = $group_table->fetch_assoc()){ 
                                  $group_id = $all_groups['id'];
                                  $group_users = "SELECT * FROM `emps` WHERE `team`=$group_id";
                                  $group_users_exe = $conn->query($group_users);
                              ?>
                           <div class="table-responsive">
                              <h3>Team Name : <?php echo $all_groups['name'];?></h3>
                              <hr>
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th scope="col">#</th>
                                       <th scope="col">Name</th>
                                       <th scope="col">Phone</th>
                                       <th scope="col">Email</th>
                                       <th scope="col">Type</th>
                                       <th scope="col">Gender</th>
                                       <th scope="col">Created Time</th>
                                       <th scope="col">Last Login</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=1;
                                       while($current_users = $group_users_exe->fetch_assoc()){ ?>
                                    <tr>
                                       <th scope="row"><?php echo $i;?></th>
                                       <td><?php echo $current_users['username'];?></td>
                                       <td><?php echo $current_users['phone'];?></td>
                                       <td><?php echo $current_users['email'];?></td>
                                       <td><?php echo $current_users['type'];?></td>
                                       <td><?php echo $current_users['gender'];?></td>
                                       <td><?php echo date("h:i:s A jS M, Y",strtotime($current_users['created_time']));?></td>
                                       <td><?php echo date("h:i:s A jS M, Y",strtotime($current_users['last_login']));?></td>
                                    </tr>
                                    <?php $i++;}
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                           <hr>
                           <br/>
                           <?php 
                              }
                              ?>
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
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
         $('#newgroup').submit(function(e){
         e.preventDefault();
         
         var all_res = document.getElementById('newgroup');
         var form_data = new FormData(all_res);
         
         $.ajax({
          url:"backend/addteam.php",
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
                    text: "Team Created successfully!!!",
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
                    text: "Failed to create Team!!!",
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
         
         $('#assignroup').submit(function(e){
         e.preventDefault();
         
         var all_res = document.getElementById('assignroup');
         var form_data = new FormData(all_res);
         
         $.ajax({
          url:"backend/assignteam.php",
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
                      text: "Team Assigned successfully!!!",
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
                      text: "Failed to assign group!!!",
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
      </script>
   </body>
</html>