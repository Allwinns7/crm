<?php
   include('backend/conn.php');
   session_start();
   $user_id = $_SESSION['user_id'];
   $user_profile = "SELECT * FROM `users` WHERE `id`=$user_id";
   $user_sql =$conn->query($user_profile);
   $user_details = $user_sql->fetch_assoc();

   $messages = "SELECT * FROM `messages` WHERE `to_id`=$user_id";
   $user_messages = $conn->query($messages);


   $notify = "SELECT * FROM `notifications` WHERE `user_id`=$user_id";
   $notify_sql = $conn->query($notify);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Profile</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
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
               <div class="header-icon"><i class="fa fa-user-circle-o"></i></div>
               <div class="header-title">
                  <h1>Profile</h1>
                  <small>User Profile Detail</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12 col-md-4">
                     <div class="card">
                        <div class="card-header">
                           <div class="card-header-headshot"></div>
                        </div>
                        <div class="card-content">
                           <div class="card-content-member text-center">
                              <h4 class="m-t-10"><?php echo $user_details['username'];?></h4>
                           </div>
                           <div class="card-content-languages">
                              <div class="card-content-languages-group">
                                 <div>
                                    <h4>Email</h4>
                                 </div>
                                 <div>
                                    <ul>
                                       <li>
                                          <?php echo $user_details['email'];?>
                                          <div class="fluency fluency-4"></div>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="card-content-languages-group">
                                 <div>
                                    <h4>Phone</h4>
                                 </div>
                                 <div>
                                    <ul>
                                       <li><?php echo $user_details['phone'];?></li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="card-content-languages-group">
                                 <div>
                                    <h4>Password</h4>
                                 </div>
                                 <div>
                                    <ul>
                                       <li><input style="border:unset;" type="password" id="spassword" value="<?php echo $user_details['password'];?>" readonly/> <i style="cursor:pointer;" onclick="changeType()" id="eye" class="fa fa-eye-slash"></i></li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="card-content-languages-group">
                                 <div>
                                    <h4>Update Password</h4>
                                 </div>
                                 <div>
                                    <ul>
                                       <li><a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal">Click</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-footer">
                           <div class="card-footer-stats">
                              <div>
                                 <p>Created:</p>
                                 <span><?php echo $user_details['created'];?></span>
                              </div>
                              <div>
                                 <p>Last Modified:</p>
                                 <span><?php echo $user_details['modified'];?></span>
                              </div>
                              <div>
                                 <p>Last Login</p>
                                 <span class="stats-small"><?php echo $user_details['last_login'];?></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                     <div class="card-footer-message">
                              <h4>Mesages</h4>
                           </div>
                     <div class="review-block">
                        <?php 
                       
                           while($all_messages = $user_messages->fetch_assoc()) { 

                              $who_send = $all_messages['from_id'];
                              $from_user = "SELECT * FROM users WHERE id=$who_send";
                              $from_sql = $conn->query($from_user);
                              $user_data = $from_sql->fetch_assoc();
                              ?>

                              <div class="row">
                                 <div class="col-sm-3">
                                    <div class="review-block-img">
                                       <img src="assets/dist/img/avatar.png" class="img-rounded" alt="">
                                    </div>
                                    <div class="review-block-name"><a href="#"><?php echo $user_data['username'];?></a></div>
                                    <div class="review-block-date"><?php echo $all_messages['datetime'];?></a></div>
                                 </div>
                                 <div class="col-sm-9">
                                    <div class="review-block-description"><?php echo $all_messages['message'];?></div>
                                 </div>
                              </div>
                              <hr/>

                        <?php 
                           }
                        ?>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-4">
                     <div class="card-footer-message">
                              <h4>Notifications</h4>
                           </div>
                     <div class="review-block">
                        <?php 
                      
                           echo "<ul class='menu'>";
                           while($all_notify = $notify_sql->fetch_assoc()) {
                              echo "<li>
                                       <a href='#' class='border-gray'>
                                       <i class='fa fa-dot-circle-o color-green'></i> ".$all_notify['notification']."</a>
                                    </li>";                     
                           }
                           echo "</ul>";
                        ?>
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <div class="modal fade" id="addsal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <h3>Update Password</h1><hr>
                     <div class="row">
                        <div class="col-md-12">
                           <form class="form-horizontal" id="updatePassword">
                              <fieldset>
                                 <div class="col-md-6 form-group">
                                    <label class="control-label">New Password</label>
                                    <input type="password" id="password" name="password" placeholder="New Password" class="form-control">
                                 </div>
                                 <!-- Text input-->
                                 <div class="col-md-6 form-group">
                                    <label class="control-label">Confirm New Password</label>
                                    <input type="text" id="cfpassword" name="cfpassword" placeholder="Confirm Password" class="form-control">
                                 </div>                                       
                                 <div class="col-md-12 form-group user-form-group">
                                    <div class="pull-left">
                                       <button type="submit" class="btn btn-add btn-sm">Update</button>
                                    </div>
                                 </div>
                              </fieldset>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include('includes/footer.inc');?>
      </div>
      <script>
         function changeType() {
            var x = document.getElementById("spassword");
           if (x.type === "password") {
             x.type = "text";
             $('#eye').removeClass('fa fa-eye-slash');
             $('#eye').addClass('fa fa-eye');
           } else {
             x.type = "password";
             $('#eye').removeClass('fa fa-eye');
             $('#eye').addClass('fa fa-eye-slash');
           }
         }
         $('#updatePassword').submit(function(e){
            e.preventDefault();
            var password = $('#password').val();
            var cfpassword = $('#cfpassword').val();

            if(password!=cfpassword) {
               alert('Password doesnot match');
            }
            else {
                  var pwd_length = password.length;
                  if(pwd_length<6) {
                     alert('Password should be 6 or more character');
                  }
                  else {
                        $.ajax({
                          url: 'backend/updatepassword.php',
                          type: 'POST',
                          data:{
                              password:password
                          },
                          async:false,
                          success: function(data){
                              if(data=='success') {
                                 $('#addsal').modal('hide');
                                 setTimeout(succ, 800);
                              }
                              else {
                                 $('#addsal').modal('hide');
                                 setTimeout(fal, 800);
                              }
                          },
                          error: function(xhr, textStatus, errorThrown) {
                              alert('Network Error, Try Later!!');
                              return false;
                          }
                      });
                  }
            }
         })
         function succ() {
            alert('Password updated successfully...');
            window.location.reload();
         }
         function fal() {
            alert('Failed to update password, try later...');
            window.location.reload();
         }
      </script>
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
       <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
   </body>
</html>