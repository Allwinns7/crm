<?php
include('backend/conn.php');
$ac_id = $_GET['id'];
$acc_details = "SELECT * FROM `accounts` WHERE `id`=$ac_id";
$acc_exe = $conn->query($acc_details);
$details = $acc_exe->fetch_assoc();

$contacts = "SELECT * FROM `contacts` WHERE acc_id=$ac_id";
$contacts_exe = $conn->query($contacts);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM - Account Detail</title>
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
               <div class="header-icon">
                  <i class="fa fa-area-chart"></i>
               </div>
               <div class="header-title">
                  <h1>Account Detail</h1>
                  <small>Account Full details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-6 col-md-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Account Information</h4>
                              <h5></h5>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-sm-6">
                              <h5>Name</h5>
                              <h6><?php echo $details['name'];?>
                           </div>
                           <div class="col-sm-6">
                              <h5>Website</h5>
                              <h6><a href="<?php echo $details['website'];?>" target="_blank"><?php echo $details['website'];?></a></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Email</h5>
                              <h6><a href="mailto:<?php echo $details['email'];?>" target="_blank"><?php echo $details['email'];?></a></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Phone</h5>
                              <h6><a href="tel:<?php echo $details['phone'];?>" target="_blank"><?php echo $details['phone'];?></a></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5><u>Billing Address</u></h5>
                              <h6 class="address-bar"><?php echo $details['baddress'];?><br/><?php echo $details['bstreet'];?><br/><?php echo $details['bcity'];?><br/><?php echo $details['bstate'];?>, <?php echo $details['bzip'];?><br/><?php echo $details['bcountry'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5><u>Shipping Address</u></h5>
                              <h6 class="address-bar"><?php echo $details['saddress'];?><br/><?php echo $details['sstreet'];?><br/><?php echo $details['scity'];?><br/><?php echo $details['sstate'];?>, <?php echo $details['szip'];?><br/><?php echo $details['scountry'];?></h6>
                           </div>
                           <div class="col-sm-12">
                              <hr size="30">
                              <h5>Detail</h5>
                           </div>
                           <div class="col-sm-6">
                              <h5>Type</h5>
                              <h6><?php echo $details['type'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Account Id</h5>
                              <h6>ARMM-<?php echo $details['id'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Industry</h5>
                              <h6><?php echo $details['industry'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Joined On</h5>
                              <h6><?php echo date("h:i:s A jS M, Y",strtotime($details['created_at']));?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Description</h5>
                              <h6><?php echo $details['description'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Last Modification</h5>
                              <h6><?php echo date("h:i:s A jS M, Y",strtotime($details['modified_at']));?></h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Contacts & Activities</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal"><i class="fa fa-plus"></i> Add Contacts</a>  
                              </div>
                              <?php
                                 $con_count = mysqli_num_rows($contacts_exe);
                                 if($con_count>0) {
                                       echo '<div class="col-sm-2">
                                                <h5>#</h5>
                                             </div>
                                             <div class="col-sm-3">
                                                <h5>Name</h5>
                                             </div>
                                             <div class="col-sm-3">
                                                <h5>Phone</h5>
                                             </div>
                                             <div class="col-sm-3">
                                                <h5>Email</h5>
                                             </div>';
                                             $cn=1;
                                       while($acc_cnts = $contacts_exe->fetch_assoc()) {

                                          echo '<div class="col-sm-2">
                                                   <h5>'.$cn.'</h5>
                                                </div>
                                                <div class="col-sm-3">
                                                   <h5>'.$acc_cnts['name'].'</h5>
                                                </div>
                                                <div class="col-sm-3">
                                                   <h6>'.$acc_cnts['phone'].'</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                   <h6>'.$acc_cnts['email'].'</h6>
                                                </div>
                                                <div class="col-sm-12">
                                                   <hr style="margin-top:5px;margin-bottom:5px;" size="10">
                                                </div>';
                                                $cn++;
                                       }
                                 }
                                 else {
                                       echo '<div class="col-sm-6">
                                             <hr size="30">
                                             <h5>No Contacts</h5>
                                             </div>';
                                 }
                              ?>
                              <h5></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal right fade" id="addsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
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
                                          <input type="hidden" name="acc_id" id="acc_id" value="<?php echo $_GET['id'];?>" >
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