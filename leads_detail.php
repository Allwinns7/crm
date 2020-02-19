<?php
include('backend/conn.php');
$ac_id = $_GET['id'];
$acc_details = "SELECT * FROM `leads` WHERE `id`=$ac_id";

$acc_exe = $conn->query($acc_details);
$details = $acc_exe->fetch_assoc();

$asg_to = $details['assigned_to'];

$asgs = "SELECT * FROM users WHERE id=$asg_to";
$asgs_exe = $conn->query($asgs);
$whi_usr = $asgs_exe->fetch_assoc();

$contacts = "SELECT * FROM `contacts` WHERE acc_id=$ac_id";
$contacts_exe = $conn->query($contacts);

$lead_act = $conn->query("SELECT * FROM `lead_activity` WHERE `lead_id`=$ac_id");
$converted_acc = $conn->query("SELECT * FROM `accounts` WHERE `convert_id`=$ac_id");
$acc_det_cnv = $converted_acc->fetch_assoc();

$oppr_acc = $conn->query("SELECT * FROM `oppurtunity` WHERE `convert_id`=$ac_id");
$oppr_det_cnv = $oppr_acc->fetch_assoc();

$cntct_acc = $conn->query("SELECT * FROM `contacts` WHERE `convert_id`=$ac_id");
$cntct_det_cnv = $cntct_acc->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM - Lead Detail</title>
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

   h5{
    font-weight: bold;
    text-decoration:underline;
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
                  <h1>Lead Detail</h1>
                  <small>Lead Full details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-6 col-md-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Lead Information</h4>
                              <h5></h5>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="col-sm-6">
                              <h5>Name</h5>
                              <h6><?php echo $details['fname'].' '.$details['lname'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Account Name</h5>
                              <h6><?php echo $details['acc'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Email</h5>
                              <h6><a href="mailto:<?php echo $details['email'];?>"><?php echo $details['email'];?></a></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Phone</h5>
                              <h6><a href="tel:<?php echo $details['phone'];?>"><?php echo $details['phone'];?></a></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Title</h5>
                              <h6><?php echo $details['title'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Website</h5>
                              <h6><a href="<?php echo $details['website'];?>" target="_blank"><?php echo $details['website'];?></a></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5><u>Address</u></h5>
                              <h6 class="address-bar"><?php echo $details['street'];?><br/><?php echo $details['city'];?><br/><?php echo $details['state'];?>, <?php echo $details['zip'];?><br/><?php echo $details['country'];?></h6>
                           </div>
                           <div class="col-sm-6">
                             <h5>Assigned To</h5>
                             <h6 class="address-bar"><?php echo $whi_usr['username'];?></h6>
                           </div>
                           
                           <div class="col-sm-12">
                              <hr size="30">
                              <h5>Details</h5>
                           </div>
                           <div class="col-sm-6">
                              <h5>Status</h5>
                              <h6>
                                <?php 
                                
                                if ($details['is_changed']!=0) { ?>
                                  <a href="javascript:void(0);"><b><?php echo $details['status'];?></b></a></h6>
                                <?php }
                                else {  ?>
                                    <a href="javascript:void(0);"><b><?php echo $details['status'];?></b></a><br/><br/>
                                  <a class="btn btn-success" href="convert.php?id=<?php echo $ac_id;?>">Convert</a>
                                  <a class="btn btn-danger" onclick="whydec(<?php echo $ac_id;?>)" data-toggle="modal" data-target="#deadModal">Dead / Declined</a>
                                  </h6>
                                <?php } ?>
                           </div>
                           <div class="col-sm-6">
                              <h5>Source</h5>
                              <h6><?php echo $details['source'];?></h6>
                              <p>&nbsp;</p>
                           </div>
                           <div class="col-sm-6">
                              <h5>Opportunity Amount</h5>
                              <h6><i class="fa fa-dollar"></i> <?php echo $details['opp'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Industry</h5>
                              <h6><?php echo $details['industry'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Description</h5>
                              <h6><?php echo $details['desc'];?></h6>
                           </div>
                           <div class="col-sm-6">
                              <h5>Created On</h5>
                              <h6><?php echo date("h:i:s A jS M, Y",strtotime($details['created_at']));?></h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Activities</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                          <table class="table table-bordered table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Activity</th>
                                       <th>Time</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                          <?php
                              while($acts = $lead_act->fetch_assoc()) { ?>
                                    <tr>
                                       <td><?php echo $acts['activity'];?></td>
                                       <td><?php echo $acts['record_time'];?></td>
                                    </tr>
                                 <?php }
                          ?>
                              </tbody>
                            </table>
                            <?php 
                                $needle = "Converted";
                                $haystack = $details['status'];
                                if (strpos($haystack, $needle) !== false) { ?>
                                      <table class="table table-bordered table-hover">
                                         <thead>
                                            <tr class="info">
                                               <th>Account Name</th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                          <tr>
                                            <td><a href="account_detail.php?id=<?php echo $acc_det_cnv['id'];?>"><?php echo $acc_det_cnv['name'];?></a></td>
                                          </tr>
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered table-hover">
                                         <thead>
                                            <tr class="info">
                                               <th>Contact Name</th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                          <tr>
                                            <td><a href="contacts.php"><?php echo $cntct_det_cnv['name'];?></a></td>
                                          </tr>
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered table-hover">
                                         <thead>
                                            <tr class="info">
                                               <th>Oppurtunity Name</th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                          <tr>
                                            <td><a href="oppurtunity.php"><?php echo $oppr_det_cnv['name'];?></a></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="modal right fade" id="deadModal" tabindex="-1" role="dialog" aria-labelledby="deadModal">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Decline Lead</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="declinelead">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Reason</label>
                                          <input type="text" name="reason" id="reason" placeholder="Why Declined" class="form-control" required="">
                                          <input type="hidden" name="dec_id" id="dec_id">
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-left">
                                             <button type="submit" class="btn btn-add">Submit</button>
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
        function whydec(did) {
          $('#dec_id').val(did);
        }
        $('#declinelead').submit(function(e){
          e.preventDefault();
                var all_res = document.getElementById('declinelead');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/declinelead.php",
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
                                text: "Status Updated successfully!!!",
                                icon: "success",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                window.location.href='leads.php';
                              });
                        }
                        else {
                            swal({
                                title: "Failed",
                                text: "Failed to update status!!!",
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