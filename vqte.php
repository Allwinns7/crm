<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   include('database_connection.php');
   $qid = $_GET['id'];
   $quote_detail = $conn->query("SELECT * FROM `arm_quote` WHERE `id` ='$qid' ");
   $qote_detail = $quote_detail->fetch_assoc();

   $ac_id = $qote_detail['order_receiver_name'];
   $account = $conn->query("SELECT * FROM `accounts` WHERE id=$ac_id");
   $account_detail = $account->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Quotation</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <style>
         .add, .cut
{
   border-width: 1px;
   display: block;
   font-size: .8rem;
   padding: 0.25em 0.5em;  
   float: left;
   text-align: center;
   width: 22px;
}

.add, .cut
{
   background: #9AF;
   box-shadow: 0 1px 2px rgba(0,0,0,0.2);
   background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
   background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
   border-radius: 0.5em;
   border-color: #0076A3;
   color: #FFF;
   cursor: pointer;
   font-weight: bold;
   text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -1.5em 8px 0; }

.add:hover { background: #00ADEE; }

.cut { }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
   * { -webkit-print-color-adjust: exact; }
   html { background: none; padding: 0; }
   body { box-shadow: none; margin: 0; }
   span:empty { display: none; }
   .add, .cut { display: none; }
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
                  <i class="fa fa-file-text"></i>
               </div>
               <div class="header-title">
                  <h1>Quotation</h1>
                  <small>Issue New Quotation</small>
               </div>
            </section>
            <div class="content" style="background:#ffffff">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
                        <div class="x_content">
                           <div class="row">
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <tr>
                                    <td colspan="2" align="center"><h2 style="margin-top:10.5px">View Quote</h2></td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                        <div class="row">
                                          <div class="col-md-8">
                                            To,<br />
                                              <p><b><?php echo $account_detail['name'];?></b></p>
                                              <p><?php echo $qote_detail['order_receiver_email'];?></p>
                                              <p><?php echo $qote_detail['order_receiver_address'];?></p>
                                          </div>
                                          <div class="col-md-4">
                                            <b>QUOTATION NO</b><br />
                                            <p><?php echo $qote_detail['id'];?></p>
                                            <b>QUOTATION DATE</b><br />
                                            <p><?php echo $qote_detail['order_date'];?></p>
                                          </div>
                                        </div>
                                        <br />
                                        <table id="invoice-item-table" class="table table-bordered">
                                          <tr>
                                            <th width="2%">Sr No.</th>
                                            <th width="20%">Product Name</th>
                                            <th width="5%">Item Garnet</th>
                                            <th width="5%">Item Grade</th>
                                            <th width="10%">Total Amount</th>
                                          </tr>
                                          <?php
                                          $statement = $connect->prepare("
                                            SELECT * FROM arm_quote_item 
                                            WHERE quote_id = :quote_id
                                          ");
                                          $statement->execute(
                                            array(
                                              ':quote_id'  =>  $_GET["id"]
                                            )
                                          );
                                          $item_result = $statement->fetchAll();
                                          $m = 0;
                                          $final_total =0;
                                          foreach($item_result as $sub_row)
                                          {
                                            $m = $m + 1;
                                            $final_total = $final_total+$sub_row["order_item_actual_amount"];
                                          ?>
                                          <tr>
                                            <td><span id="sr_no"><?php echo $m; ?></span></td>
                                            <td><?php echo $sub_row["item_name"];?></td>
                                            <td><?php echo $sub_row["order_item_garnet"];?></td>
                                            <td><?php echo $sub_row["order_item_grade"]; ?></td>
                                            <td>$<?php echo $sub_row["order_item_actual_amount"];?></td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                          <tr>
                                            <td colspan="4" align="right"><b>Total</b></td>
                                            <td>$<?php echo $final_total;?></td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                    
                                    <tr>
                                      <td><b>Specification</b></td>
                                      <td><?php echo $qote_detail['specification'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Packaging</b></td>
                                      <td><?php echo $qote_detail['packaging'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Payment Term</b></td>
                                      <td><?php echo $qote_detail['paymentterm'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Shipper</b></td>
                                      <td><?php echo $qote_detail['shipper'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Bank Detail</b></td>
                                      <td><?php echo $qote_detail['bankdetails'];?></td>
                                    </tr>
                                    
                                </table>
                              </div>
                            </form>     
                           </div>
                        </div>
                     </div>
                     <br><br><br>
                  </div>
               </div>
            </div>
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
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
   </body>
</html>