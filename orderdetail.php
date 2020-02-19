<?php
   include('includes/auth.inc');
   include('database_connection.php');
   $order_total_before_tax = 0;
      $order_total_tax1 = 0;
      $order_total_tax2 = 0;
      $order_total_tax3 = 0;
      $order_total_tax = 0;
      $order_total_after_tax = 0;
      
      $order_id = $_GET["order_id"];
      
      
      
      $statement = $connect->prepare("
                DELETE FROM tbl_order_item WHERE order_id = :order_id
            ");
            $statement->execute(
                array(
                    ':order_id'       =>      $order_id
                )
            );
      
      for($count=0; $count<$_POST["total_item"]; $count++)
      {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
        $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));
        $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));
        $order_total_tax3 = $order_total_tax3 + floatval(trim($_POST["order_item_tax3_amount"][$count]));
        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));
        $statement = $connect->prepare("
          INSERT INTO tbl_order_item 
          (order_id, item_name, order_item_quantity, order_item_price, order_item_actual_amount, order_item_tax1_rate, order_item_tax1_amount, order_item_tax2_rate, order_item_tax2_amount, order_item_tax3_rate, order_item_tax3_amount, order_item_final_amount) 
          VALUES (:order_id, :item_name, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_tax1_rate, :order_item_tax1_amount, :order_item_tax2_rate, :order_item_tax2_amount, :order_item_tax3_rate, :order_item_tax3_amount, :order_item_final_amount)
        ");
        $statement->execute(
          array(
            ':order_id'                 =>  $order_id,
            ':item_name'                =>  trim($_POST["item_name"][$count]),
            ':order_item_quantity'          =>  trim($_POST["order_item_quantity"][$count]),
            ':order_item_price'            =>  trim($_POST["order_item_price"][$count]),
            ':order_item_actual_amount'     =>  trim($_POST["order_item_actual_amount"][$count]),
            ':order_item_tax1_rate'         =>  trim($_POST["order_item_tax1_rate"][$count]),
            ':order_item_tax1_amount'       =>  trim($_POST["order_item_tax1_amount"][$count]),
            ':order_item_tax2_rate'         =>  trim($_POST["order_item_tax2_rate"][$count]),
            ':order_item_tax2_amount'       =>  trim($_POST["order_item_tax2_amount"][$count]),
            ':order_item_tax3_rate'         =>  trim($_POST["order_item_tax3_rate"][$count]),
            ':order_item_tax3_amount'       =>  trim($_POST["order_item_tax3_amount"][$count]),
            ':order_item_final_amount'      =>  trim($_POST["order_item_final_amount"][$count])
          )
        );
        $result = $statement->fetchAll();
      }
      $order_total_tax = $order_total_tax1 + $order_total_tax2 + $order_total_tax3;
      
      $statement = $connect->prepare("
        UPDATE tbl_order 
        SET order_no = :order_no, 
        order_date = :order_date, 
        order_receiver_name = :order_receiver_name, 
        order_receiver_address = :order_receiver_address, 
        order_total_before_tax = :order_total_before_tax, 
        order_total_tax1 = :order_total_tax1, 
        order_total_tax2 = :order_total_tax2, 
        order_total_tax3 = :order_total_tax3, 
        order_total_tax = :order_total_tax, 
        order_total_after_tax = :order_total_after_tax 
        WHERE order_id = :order_id 
      ");
      
      $statement->execute(
        array(
          ':order_no'               =>  trim($_POST["order_no"]),
          ':order_date'             =>  trim($_POST["order_date"]),
          ':order_receiver_name'        =>  trim($_POST["order_receiver_name"]),
          ':order_receiver_address'     =>  trim($_POST["order_receiver_address"]),
          ':order_total_before_tax'     =>  $order_total_before_tax,
          ':order_total_tax1'          =>  $order_total_tax1,
          ':order_total_tax2'          =>  $order_total_tax2,
          ':order_total_tax3'          =>  $order_total_tax3,
          ':order_total_tax'           =>  $order_total_tax,
          ':order_total_after_tax'      =>  $order_total_after_tax,
          ':order_id'               =>  $order_id
        )
      );
      
      $result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Order Detail</title>
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
                  <h1>Order Detail</h1>
                  <small>Order Detail</small>
               </div>
            </section>
            <div class="content" style="background:#ffffff">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
                        <div class="x_content">
                           <div class="row">
                              <?php 
                              $statement = $connect->prepare("
                                SELECT * FROM tbl_order 
                                  WHERE order_id = :order_id
                                  LIMIT 1
                              ");
                              $statement->execute(
                                array(
                                  ':order_id'       =>  $_GET["id"]
                                  )
                                );
                              $result = $statement->fetchAll();
                              foreach($result as $row)
                              {
                              ?>
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <tr>
                                    <td colspan="2" align="center"><h2 style="margin-top:10.5px">View Invoice</h2></td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                        <div class="row">
                                          <div class="col-md-8">
                                            To,<br />
                                              <b>RECEIVER (BILL TO)</b><br />
                                              <p><?php echo $row["order_receiver_name"]; ?></p>
                                              <p><?php echo $row["order_receiver_email"]; ?></p>
                                              <p><?php echo $row["order_receiver_address"]; ?></p>
                                          </div>
                                          <div class="col-md-4">
                                            Reverse Charge<br />
                                            <p><?php echo $row["order_no"]; ?></p>
                                            <p><?php echo $row["order_date"]; ?></p>
                                          </div>
                                        </div>
                                        <br />
                                        <table id="invoice-item-table" class="table table-bordered">
                                          <tr>
                                            <th width="7%">Sr No.</th>
                                            <th width="20%">Item Name</th>
                                            <th width="5%">Quantity</th>
                                            <th width="5%">Price</th>
                                            <th width="10%">Actual Amt.</th>
                                            <th width="12.5%" colspan="2">Tax1 (%)</th>
                                            <th width="12.5%" colspan="2">Tax2 (%)</th>
                                            <th width="12.5%" colspan="2">Tax3 (%)</th>
                                            <th width="12.5%" rowspan="2">Total</th>
                                            <th width="3%" rowspan="2"></th>
                                          </tr>
                                          <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Rate</th>
                                            <th>Amt.</th>
                                            <th>Rate</th>
                                            <th>Amt.</th>
                                            <th>Rate</th>
                                            <th>Amt.</th>
                                          </tr>
                                          <?php
                                          $statement = $connect->prepare("
                                            SELECT * FROM tbl_order_item 
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
                                          ?>
                                          <tr>
                                            <td><span id="sr_no"><?php echo $m; ?></span></td>
                                            <td><?php echo $sub_row["item_name"];?></td>
                                            <td><?php echo $sub_row["order_item_quantity"];?></td>
                                            <td><?php echo $sub_row["order_item_price"]; ?></td>
                                            <td><?php echo $sub_row["order_item_actual_amount"];?></td>
                                            <td><?php echo $sub_row["order_item_tax1_rate"]; ?></td>
                                            <td><?php echo $sub_row["order_item_tax1_amount"];?></td>
                                            <td><?php echo $sub_row["order_item_tax2_rate"];?></td>
                                            <td><?php echo $sub_row["order_item_tax2_amount"]; ?></td>
                                            <td><?php echo $sub_row["order_item_tax3_rate"]; ?></td>
                                            <td><?php echo $sub_row["order_item_tax3_amount"]; ?></td>
                                            <td><?php echo $sub_row["order_item_final_amount"]; ?></td>
                                            <td></td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right"><b>Total</td>
                                      <td align="right"><b><span id="final_total_amt"><?php echo $row["order_total_after_tax"]; ?></span></b></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center">
                                        
                                      </td>
                                    </tr>
                                </table>
                              </div>
                            </form>
                              <?php 
                              } ?>
      
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
      <script>
        function convertOrder(id) {
          $.ajax({
            url: 'backend/place_order.php',
            type: 'POST',
            data:{
                id:id
            },
            async:false,
            success: function(data){
                var result = JSON.parse(data);
                if(result.status=='success') {
                   swal({
                     title: "Success",
                     text: "Converted to Order Successfully!!!",
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
                     text: "Failed to Convert Quote to Order!!",
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                   })
                   .then((willDelete) => {
                     window.location.reload();
                   });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                alert('Network Error, Try Later!!');
                return false;
            }
          });
        }
        function rejectOrder(id) {
          swal({
              title: "Are you sure?",
              text: "Do you want to reject this Quotation !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deleteoppr.php',
                    type: 'POST',
                    data:{
                        id:id
                    },
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                           swal({
                             title: "Success",
                             text: "Oppurtunity Deleted successfully!!!",
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
                             text: "Failed to delete Oppurtunity details!!",
                             icon: "warning",
                             buttons: true,
                             dangerMode: true,
                           })
                           .then((willDelete) => {
                             window.location.reload();
                           });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Network Error, Try Later!!');
                        return false;
                    }
                  });
              }
            });
        }
      </script>
   </body>
</html>