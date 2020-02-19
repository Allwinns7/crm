<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $consignee = $conn->query("SELECT * FROM `arm_consignee` ORDER BY `name` ASC");
   $notifyparty = $conn->query("SELECT * FROM `arm_notifyparty` ORDER BY `name` ASC");
   $delivery = $conn->query("SELECT * FROM `arm_delivery_terms` ORDER BY `desc` ASC");
   $term = $conn->query("SELECT * FROM `arm_payment_terms` ORDER BY `desc` ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Quotation Config</title>
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
                  <h1>Quotation</h1>
                  <small>Add Quotation Configuration</small>
               </div>
            </section>
            <section class="content">
               <!-- Alert Message -->
               <!-- New customer -->
               <div class="row">
                  <div class="col-sm-3">
                    <div class="resultDiv1"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add Consignee </h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="consignee" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label for="category_name" class="col-sm-3 col-form-label">Consignee Name <i class="text-danger">*</i></label>
                                 <div class="col-sm-9">
                                    <input class="form-control" name="consignee_name" id="consignee_name" type="text" placeholder="Consignee Name" required="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                <label for="category_name" class="col-sm-3 col-form-label">Consignee Address <i class="text-danger">*</i></label>
                                 <div class="col-sm-9">
                                   <textarea name="consignee_address" id="consignee_address" class="form-control" placeholder="Consignee Address" rows="4"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-customer" class="btn custom_btn custom_fontcolor btn-large" name="add-customer" value="Save">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="resultDiv2"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add Notify Party </h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="party" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label for="category_name" class="col-sm-3 col-form-label">Party Name <i class="text-danger">*</i></label>
                                 <div class="col-sm-9">
                                    <input class="form-control" name="party_name" id="party_name" type="text" placeholder="Party Name" required="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                <label for="category_name" class="col-sm-3 col-form-label">Party Address <i class="text-danger">*</i></label>
                                 <div class="col-sm-9">
                                   <textarea name="party_address" id="party_address" class="form-control" placeholder="Party Address" rows="4"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-customer" class="btn custom_btn custom_fontcolor btn-large" name="add-customer" value="Save">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="resultDiv3"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Terms Of Delivery </h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="delivery" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label for="category_name" class="col-sm-3 col-form-label">Delivery Term <i class="text-danger">*</i></label>
                                 <div class="col-sm-9">
                                    <input class="form-control" name="delivery_term" id="delivery_term" type="text" placeholder="Delivery Terms" required="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-customer" class="btn custom_btn custom_fontcolor btn-large" name="add-customer" value="Save">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="resultDiv4"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Payment Terms </h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="payment" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label for="category_name" class="col-sm-3 col-form-label">Payment Term <i class="text-danger">*</i></label>
                                 <div class="col-sm-9">
                                    <input class="form-control" name="payment_term" id="payment_term" type="text" placeholder="Payment Term" required="">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-customer" class="btn custom_btn custom_fontcolor btn-large" name="add-customer" value="Save">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Consignees</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th class="text-center">SL.</th>
                                       <th class="text-center">Consignee</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                    $cs =1 ;
                                    while($consignees = $consignee->fetch_assoc()) { ?>

                                        <tr>
                                         <td class="text-center"><?php echo $cs;?></td>
                                         <td class="text-center"><?php echo $consignees['name']."<br>".$consignees['address'];?></td>
                                         <td>
                                            <center>
                                              <a href="" class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $consignees['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </center>
                                         </td>
                                      </tr>

                                    <?php
                                    $cs++;
                                    }
                                  ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Notify Party</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th class="text-center">SL.</th>
                                       <th class="text-center">Party Name</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                    $ps =1 ;
                                    while($partys = $notifyparty->fetch_assoc()) { ?>

                                        <tr>
                                         <td class="text-center"><?php echo $ps;?></td>
                                         <td class="text-center"><?php echo $partys['name']."<br>".$partys['address'];?></td>
                                         <td>
                                            <center>
                                              <a href="" class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $partys['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </center>
                                         </td>
                                      </tr>

                                    <?php
                                    $ps++;
                                    }
                                  ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Delivery Terms</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th class="text-center">SL.</th>
                                       <th class="text-center">Delivery Term</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                    $ds =1 ;
                                    while($deliverys = $delivery->fetch_assoc()) { ?>

                                        <tr>
                                         <td class="text-center"><?php echo $ds;?></td>
                                         <td class="text-center"><?php echo $deliverys['desc'];?></td>
                                         <td>
                                            <center>
                                              <a href="" class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $deliverys['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </center>
                                         </td>
                                      </tr>

                                    <?php
                                    $ds++;
                                    }
                                  ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Payment Terms</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th class="text-center">SL.</th>
                                       <th class="text-center">Payment Term</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                    $ts =1 ;
                                    while($terms = $term->fetch_assoc()) { ?>

                                        <tr>
                                         <td class="text-center"><?php echo $ts;?></td>
                                         <td class="text-center"><?php echo $terms['desc'];?></td>
                                         <td>
                                            <center>
                                              <a href="" class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $terms['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </center>
                                         </td>
                                      </tr>

                                    <?php
                                    $ts++;
                                    }
                                  ?>
                                 </tbody>
                              </table>
                           </div>
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

         $('#consignee').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('consignee');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addconsignee.php",
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
                              $('.resultDiv1').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Consignee Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv1').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Consignee Failed to Add !</div>');
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
         $('#party').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('party');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addparty.php",
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
                              $('.resultDiv2').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Notify Party Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv2').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Notify Party Failed to Add !</div>');
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
         $('#delivery').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('delivery');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/adddelivery.php",
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
                              $('.resultDiv3').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Delivery Term Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv3').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Delivery Term Failed to Add !</div>');
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
         $('#payment').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('payment');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addterm.php",
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
                              $('.resultDiv4').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Payment Term Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv4').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Payment Term Failed to Add !</div>');
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