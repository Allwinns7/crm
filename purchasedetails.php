<?php
   include('includes/auth.inc');
   include('backend/conn.php');

   include('database_connection.php');
   $oid=$_GET['id'];
   $sname = $_GET['sn'];
   $pid= $_GET['pno'];
   $pdt = $_GET['pdate'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Purchase Ledger</title>
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
                  <h1>Purchase Ledger</h1>
                  <small>Purchase Ledger</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title" style="display: flex; align-content: center; justify-content: space-between;">
                              <h4>Invoice Information</h4>
                           </div>
                        </div>
                        <div class="panel-body" id="printableArea">
                           <div class="table">
                              <div style="text-align: center;">
                                 Supplier Name : &nbsp;<span style="font-weight:normal"><?php echo $sname;?></span>  <span style="margin-left:800px;float:right"> </span> <br>
                                 Date :&nbsp; <?php echo $pdt;?><br>Purchase No :&nbsp; <?php echo $pid;?> <br>  <span style="float:right">Print Date : <?php echo date('Y-m-d h:i:s');?></span>
                              </div>
                              <div id="dataTableExample2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                 <div class="row">
                                    <div class="col-sm-4 text-center"></div>
                                    
                                    <div class="col-sm-4"></div>
                                 </div>
                                 <table id="dataTableExample2" class="table table-bordered table-striped table-hover dataTable" role="grid">
                                    <thead>
                                       <tr role="row">
                                          <th>SL.</th>
                                          <th>Product</th>
                                          <th class="text-right">Price</th>
                                          <th class="text-right">Quantity</th>
                                          <th class="text-right">Total Amount</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $orders = $conn->query("SELECT * FROM `arm_purchase` WHERE `order_id`=$oid");
                                          $order_detail = $orders->fetch_assoc();

                                          $statement = $connect->prepare("
                                            SELECT * FROM arm_purchase_item 
                                            WHERE order_id = :order_id
                                          ");
                                          $statement->execute(
                                            array(
                                              ':order_id'       =>  $_GET["id"]
                                            )
                                          );
                                          $item_result = $statement->fetchAll();
                                          $m = 0;
                                          foreach($item_result as $sub_row)
                                          {
                                            $m = $m + 1;

                                            $item_id = $sub_row["product_id"];
                                            $product_name = "SELECT * FROM `products` WHERE id=$item_id";
                                            $product_exe = $conn->query($product_name);
                                            $item_fetch = $product_exe->fetch_assoc();

                                          ?>
                                          <tr>
                                            <td><span id="sr_no"><?php echo $m; ?></span></td>
                                            <td><?php echo $item_fetch['name'];?></td>
                                            <td align="right"><?php echo $sub_row["rate"];?></td>
                                            <td align="right"><?php echo $sub_row["quantity"]; ?></td>
                                            <td align="right"><?php echo $sub_row["total"];?></td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                          <tr>
                                            <td colspan="4" align="right"><b>Tax</td>
                                            <td align="right"><b><span id="final_total_amt"><?php echo $order_detail["vat"]; ?></span></b></td>
                                          </tr>
                                           <tr>
                                            <td colspan="4" align="right"><b>Total</td>
                                            <td align="right"><b><span id="final_total_amt"><?php echo $order_detail["total_amount"]; ?></span></b></td>
                                          </tr>
                                    </tbody>
                                 </table>
                              </div>
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
          $(document).ready(function(){
              manageOrderTable = $("#dataTableExample2xx").DataTable({
                'ajax': 'php_action/fetchpurchase.php',
                'order': []
              });
          });
      </script>
   </body>
</html>