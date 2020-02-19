<?php
   include('includes/auth.inc'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | All Orders</title>
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
                  <i class="fa fa-file-text"></i>
               </div>
               <div class="header-title">
                  <h1>Orders</h1>
                  <small>All Orders</small>
               </div>
            </section>
            <div class="content" style="background:#ffffff">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Orders</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="neworder.php" class="btn btn-add"><i class="fa fa-plus"></i> New Orders</a> 
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="manageOrderTable" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                      <th>#</th>
                                      <th>Order Date</th>
                                      <th>Client Name</th>
                                      <th>Contact Email</th>
                                      <th>Total Order Item</th>
                                      <th>Payment Status</th>
                                      <th>Option</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- edit order -->
        <div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
              </div>      

              <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

                <div class="paymentOrderMessages"></div>

                                     
                <div class="form-group">
                  <label for="due" class="col-sm-3 control-label">Due Amount</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="due" name="due" disabled="true" />          
                  </div>
                </div> <!--/form-group-->   
                <div class="form-group">
                  <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="payAmount" name="payAmount"/>               
                  </div>
                </div> <!--/form-group-->   
                <div class="form-group">
                  <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="paymentType" id="paymentType" >
                      <option value="">~~SELECT~~</option>
                      <option value="1">Cheque</option>
                      <option value="2">Cash</option>
                      <option value="3">Credit Card</option>
                    </select>
                  </div>
                </div> <!--/form-group-->               
                <div class="form-group">
                  <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="paymentStatus" id="paymentStatus">
                      <option value="">~~SELECT~~</option>
                      <option value="1">Full Payment</option>
                      <option value="2">Advance Payment</option>
                      <option value="3">No Payment</option>
                    </select>
                  </div>
                </div> <!--/form-group-->                         
                        
              </div> <!--/modal-body-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>  
              </div>           
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- remove order -->
        <div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
              </div>
              <div class="modal-body">

                <div class="removeOrderMessages"></div>

                <p>Do you really want to remove ?</p>
              </div>
              <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php include('includes/footer.inc');?>
      </div>
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="assets/order.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
         $(document).ready(function(){
          manageOrderTable = $("#manageOrderTable").DataTable({
            'ajax': 'php_action/fetchOrder.php',
            'order': []
          });
      });
      </script>
   </body>
</html>