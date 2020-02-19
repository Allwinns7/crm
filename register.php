<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRM -  Register</title>
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background-image:url('assets/login.jpg');background-size: cover;background-repeat: no-repeat; ">
        <div class="login-wrapper">
            <div class="container-center lg">
             <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Register</h3>
                                <small><strong>Please enter your data to register.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Username</label>
                                    <input type="text" id="username" class="form-control" name="username" autocomplete="off">
                                    <span class="help-block small">Your unique username to app</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" id="password" class="form-control" name="password" autocomplete="off">
                                    <span class="help-block small">Your hard to guess password</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Repeat Password</label>
                                    <input type="password" id="repeatpassword" class="form-control" name="repeatpassword" autocomplete="off">
                                    <span class="help-block small">Please repeat your pasword</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email Address</label>
                                    <input type="email" id="email" class="form-control" name="email">
                                    <span class="help-block small">Your address email to contact</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Phone Number</label>
                                    <input type="number" id="phone" class="form-control" name="phone">
                                    <span class="help-block small">Your phone number to contact</span>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-warning">Register</button>
                                <a class="btn btn-add" href="login.php">Login</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
        <script>
            $('#loginForm').submit()
        </script>
    </body>
</html>