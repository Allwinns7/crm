<?php 
if(isset($_GET['redirect_uri'])) {
    $recirectURI = $_GET['redirect_uri'];
}
else {
  $recirectURI = 'http://localhost/crm-app/index.php';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRM | Login</title>
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
          .panel-custom > .panel-heading{
              background: #183465 !important;
          }
          .panel .panel-heading h3,
          .panel-custom > .panel-heading{
            color:#fff;
          }
        </style>
    </head>
    <body  style="background-image:url('assets/login1.jpg');background-size: cover;background-repeat: no-repeat; ">
        <div class="login-wrapper">
            <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" title="Please enter you username" required="required" name="username" id="username" class="form-control" autocomplete="off">
                                <span class="help-block small">Your unique username to app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="required" name="password" id="password" class="form-control" autocomplete="off">
                                <span class="help-block small">Your strong password</span>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Login</button>
                                <button type="button"  data-toggle="modal" data-target="#addsal" class="btn btn-danger">Forgot Password</button>
                            </div>
                        </form>
                        </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addsal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <h3>Forgot Password</h1><hr>
                     <div class="row">
                        <div class="col-md-12">
                           <form class="form-horizontal" id="updatePassword">
                              <fieldset>
                                 <div class="col-md-12 form-group">
                                    <label class="control-label">Enter Registered Email Id</label>
                                    <input type="email" id="email" name="email" placeholder="Email Id" class="form-control">
                                 </div>
                                 <div class="col-md-12 form-group user-form-group">
                                    <div class="pull-left">
                                       <button type="submit" class="btn btn-add btn-sm">Request</button>
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
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
        <script>
            $('#loginForm').submit(function(e){
                e.preventDefault();
                var all_res = document.getElementById('loginForm');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/auth.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                            window.location.href='<?php echo $recirectURI;?>';
                        }
                        else {
                            alert(result.message);
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
            });
            $('#updatePassword').submit(function(e){
                e.preventDefault();
                var email = $('#email').val();
                $.ajax({
                  url: 'backend/forgotpassword.php',
                  type: 'POST',
                  data:{
                      email:email
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
            });
            function succ() {
                alert('Password reset request sent to your register mail id');
                window.location.reload();
            }
             function fal() {
                $('#email').val('');
                alert('Account doesnot exist, contact administrator');
                //window.location.reload();
             }
        </script>
    </body>
</html>