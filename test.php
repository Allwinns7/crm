<?php
   include('includes/auth.inc');
   include('database_connection.php');
   include('backend/conn.php');

   $qid = $_GET['id'];
   $quotes = $conn->query("SELECT * FROM `arm_quote` WHERE `id`='$qid'");
   $quotes_detail = $quotes->fetch_assoc();

   $client_id = $quotes_detail['order_receiver_name'];
   $clients = $conn->query("SELECT * FROM `accounts` WHERE `id`=$client_id");
   $client_detail = $clients->fetch_assoc();

   $bank_id = $quotes_detail['bank'];
   $banks = $conn->query("SELECT * FROM `arm_bank` WHERE `id`=$bank_id");
   $bank_detail = $banks->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Proforma Invoice</title>
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
        .page {
  width: 21cm;
  min-height: 29.7cm;
  padding: 10px;

  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
@page {
  size: A4;
  margin: 0;
}

@media print {
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
.page1 {
    width: 21cm;
    padding:unset;
}
table td, table p{
  font-size: 12px;
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
                  <h1>Proforma Invoice</h1>
                  <small>Proforma Invoice Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                    <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Proforma Invoice</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 page1">
                              <div class="buttonexport"> 
                                 <a href="editproforma.php?id=<?php echo $_GET['id'];?>" class="btn btn-add"><i class="fa fa-edit"></i> Edit</a>  
                                  <a href="#" class="btn btn-success pull-right"><i class="fa fa-check"></i> Convert</a>  
                              </div>
                            </div>
                            <div class="col-sm-2"></div>
                          </div>
                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 page">
                              <div class="row">
                                <div class="col-sm-6">
                                    <img src="assets/dist/img/logo.png"  style="width: 170px;" />
                                </div>
                                <div class="col-sm-6 text-right">
                                  <h3>PROFORMA INVOICE</h3>
                                </div>
                              </div><br>
                              <table class="table table-bordered">
                                <tr>
                                  <td>
                                    <b>Exporter / Name of Shipper / Beneficiary</b>
                                    <p>
                                      ARIMA MINERALS FZ - LC<br>
                                      TI-6F-ZA, RAKEZ AMENITY CENTER<br>
                                      AL HAMRA INDUSTRIAL ZONE - FZ RAK,<br>
                                      UNITED ARAB EMIRATES
                                    </p>
                                  </td>
                                  <td>
                                    <b>Proforma Invoice No : <?php echo $_GET['id'];?></b> <br>
                                    <b>Dated : <?php echo date('d-m-Y',strtotime($quotes_detail['order_date']));?></b> <br>
                                    <b>Validity Date : </b><br>
                                  </td>
                                </tr>
                                <tr>
                                  <th rowspan="2">
                                    <b>Consignee</b>
                                    <p>
                                      <?php echo $client_detail['name'];?><br>
                                      <?php echo $client_detail['baddress'].$client_detail['bstreet'];?>,<br>
                                      <?php echo $client_detail['bcity'].$client_detail['bstate'];?><br>
                                      <?php echo $client_detail['bcountry'].$client_detail['bzip'];?>
                                    </p>
                                  </th>
                                  <td>
                                    <b>Buyer's Order and Date</b><br>
                                    ARI-191025<br><br>
                                    of
                                  </td>
                                </tr>
                                <tr>
                                  <td> <b>Other References : </b></td>
                                </tr>
                                <tr>
                                  <td>
                                   <b>Notify Party</b>
                                    <p>
                                      <?php echo $client_detail['name'];?><br>
                                      <?php echo $client_detail['baddress'].$client_detail['bstreet'];?>,<br>
                                      <?php echo $client_detail['bcity'].$client_detail['bstate'];?><br>
                                      <?php echo $client_detail['bcountry'].$client_detail['bzip'];?>
                                    </p>
                                  </td>
                                  <td>
                                   <b>Buyer (other than Consignee)</b>
                                    <p>
                                      <?php echo $client_detail['name'];?><br>
                                      <?php echo $client_detail['baddress'].$client_detail['bstreet'];?>,<br>
                                      <?php echo $client_detail['bcity'].$client_detail['bstate'];?><br>
                                      <?php echo $client_detail['bcountry'].$client_detail['bzip'];?>
                                    </p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <table class="table" style="margin-bottom: 0px;margin-top:-10px">
                                      <tr>
                                        <td>
                                          Vessel Name MV <br>
                                          MV.
                                        </td>
                                        <td>
                                          Port of Loading <br>
                                          TUTICORIN PORT <br>
                                          INDIA
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          DIscharge Port
                                        </td>
                                        <td>
                                          Final Destination <br>
                                          KOREA
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                  <td>
                                    <b>Terms of Delivery :</b><br>
                                    FOB TUTICORIN PORT, INDIA<br>
                                    <b>Payment Terms : </b><br>
                                    <?php echo $quotes_detail['paymentterm'];?>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="2">
                                    <table class="table"  style="margin-bottom: 0px;margin-top:-10px">
                                      <tr>
                                        <th>Marks & Nos.</th>
                                        <th>No. & Kind of <br> Packages</th>
                                        <th>Description of Goods</th>
                                        <th>Quantity <br> in MTS</th>
                                        <th>Rate in <br>USD / MT.</th>
                                        <th>Amount <br> USD </th>
                                      </tr>
                                      <?php
                                          $statement = $connect->prepare("
                                            SELECT * FROM arm_quote_item 
                                            WHERE quote_id = :quote_id
                                          ");
                                          $statement->execute(
                                            array(
                                              ':quote_id'       =>  $_GET["id"]
                                            )
                                          );
                                          $item_result = $statement->fetchAll();
                                          $m = 0;
                                          $over_all_total =0;
                                          $over_all_quant =0;
                                          foreach($item_result as $sub_row)
                                          {
                                            $m = $m + 1;
                                            $over_all_total += $sub_row["order_item_quantity"]*$sub_row["order_item_actual_amount"];
                                            $over_all_quant += $sub_row["order_item_quantity"];
                                          ?>
                                      <tr>
                                        <td>
                                          NIL <br> 1x20' cntrs
                                        </td>
                                        <td>
                                          <?php echo $sub_row["item_name"]; ?>
                                        </td>
                                        <td>
                                          <b><?php echo $sub_row["order_item_garnet"]; ?></b>
                                        </td>
                                        <td>
                                          <?php echo number_format($sub_row["order_item_quantity"]); ?>
                                        </td>
                                        <td>
                                          <?php echo number_format($sub_row["order_item_actual_amount"],2); ?>
                                        </td>
                                        <td>
                                          <?php echo number_format($sub_row["order_item_quantity"]*$sub_row["order_item_actual_amount"],2); ?>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                      <tr>
                                        <td colspan="3">
                                          <b>Total Amount Chargable : </b><br>
                                          (IN WORDS) <br><br>
                                           US DOLLAR <?php echo get_amnts($over_all_total);?><br><br><br>
                                        </td>
                                        <td>
                                           <?php echo $over_all_quant;?>
                                        </td>
                                        <td>
                                          <b>TOTAL</b>
                                        </td>
                                        <td>
                                          <?php echo number_format($over_all_total,2);?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="6">
                                          <b>Terms & Conditions : </b><br>
                                          <table>
                                            <tr>
                                              <td>PARTIAL SHIPMENT</td>
                                              <td> : Allowed</td>
                                            </tr>
                                            <tr>
                                              <td>TRANSHIPMENT</td>
                                              <td> : Allowed</td>
                                            </tr>
                                            <tr>
                                              <td>SHIPMENT DATE</td>
                                              <td> : ASAP</td>
                                            </tr>
                                            <tr>
                                              <td>SHIPMENT IN</td>
                                              <td> : 1x20' cntrs</td>
                                            </tr>
                                            <tr>
                                              <td>O.FRIEGHT</td>
                                              <td> : To Buyer's Account</td>
                                            </tr>
                                            <tr>
                                              <td>INSURANCE</td>
                                              <td> : Allowed</td>
                                            </tr>
                                          </table>
                                        </td>
                                        
                                      </tr>
                                      <tr>
                                        <td colspan="6">
                                          <b>Bank Details : </b><br>
                                          Account Name : <?php echo $bank_detail['ac_name'];?> <br>
                                          Account No : <?php echo $bank_detail['ac_no'];?><br> 
                                          Bank Name : <?php echo $bank_detail['bank_name'];?> <br>
                                          Branch : <?php echo $bank_detail['branch'];?><br><br>
                                          <p>We declare that thus invoice shows the actual price of the goods
                                           described and that all particulars are true and correct</p>
                                        </td>
                                        
                                      </tr>
                                    </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="border:1px solid #000">
                                       Above terms  and conditions accepted <br>
                                       for <?php echo $client_detail['name'];?> <br><br><br><br>
                                       <p>AUTNORISED SIGNATORY <br> Company Seal / Stamp</p>
                                    </td>
                                    <td style="border:1px solid #000">
                                       Signature <br>
                                       for ARIMA MINERALS FZ-LC <br><br><br><br>
                                       <p>AUTNORISED SIGNATORY <br> Company Seal / Stamp</p>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </div>
                            <div class="col-sm-2"></div>
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
      <?php 
        function get_amnts($amnt) {
          $number = $amnt;
          $no = round($number);
          $point = round($number - $no, 2) * 100;
          $hundred = null;
          $digits_1 = strlen($no);
          $i = 0;
          $str = array();
          $words = array('0' => '', '1' => 'ONE', '2' => 'TWO',
              '3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
              '7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
              '10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
              '13' => 'THIRTEEN', '14' => 'FOURTEEN',
              '15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
              '18' => 'EIGHTEEN', '19' =>'NINTEEN', '20' => 'TWENTY',
              '30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
              '60' => 'SIXTY', '70' => 'SEVENTY',
              '80' => 'EIGHTY', '90' => 'NINETY');
          $digits = array('', 'HUNDRED', 'THOUSAND', 'LAHK', 'CRORE');
          while ($i < $digits_1) {
              $divider = ($i == 2) ? 10 : 100;
              $number = floor($no % $divider);
              $no = floor($no / $divider);
              $i += ($divider == 10) ? 1 : 2;
              if ($number) {
                  $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                  $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                  $str [] = ($number < 21) ? $words[$number] .
                      " " . $digits[$counter] . $plural . " " . $hundred
                      :
                      $words[floor($number / 10) * 10]
                      . " " . $words[$number % 10] . " "
                      . $digits[$counter] . $plural . " " . $hundred;
              } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          $points = ($point) ?
              "." . $words[$point / 10] . " " .
              $words[$point = $point % 10] : '';
          return $result . " ONLY";
      }
      ?>
   </body>
</html>