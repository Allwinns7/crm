<?php
   include('includes/auth.inc');
   include('backend/conn.php');
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
                                    <b>Proforma Invoice No : </b> <br>
                                    <b>Dated : </b> <br>
                                    <b>Validity Date : </b><br>
                                  </td>
                                </tr>
                                <tr>
                                  <th rowspan="2">
                                    <b>Consignee</b>
                                    <p>
                                      SB ENGINEERINGS<br>
                                      GYUNGGI-DO SEONGNAM-SI JOONGWON-GU,<br>
                                      DUNCHONDAERO 388-GIL<br>
                                      24/1212, SEOUL, KOREA
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
                                      SB ENGINEERINGS<br>
                                      GYUNGGI-DO SEONGNAM-SI JOONGWON-GU,<br>
                                      DUNCHONDAERO 388-GIL<br>
                                      24/1212, SEOUL, KOREA
                                    </p>
                                  </td>
                                  <td>
                                   <b>Buyer (other than Consignee)</b>
                                    <p>
                                      SB ENGINEERINGS<br>
                                      GYUNGGI-DO SEONGNAM-SI JOONGWON-GU,<br>
                                      DUNCHONDAERO 388-GIL<br>
                                      24/1212, SEOUL, KOREA
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
                                    100% ADVANCE PAYMENT BY WAY OF TT
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
                                      <tr>
                                        <td>
                                          NIL <br> 1x20' cntrs
                                        </td>
                                        <td>
                                          IN 1MT BAG <br>TOTAL BAGS
                                        </td>
                                        <td>
                                          <b>GARNET MK#80 <br> </b>
                                          H.S.Code : 25132030
                                        </td>
                                        <td>
                                          27.000
                                        </td>
                                        <td>
                                          265.00
                                        </td>
                                        <td>
                                          7,155.00
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="3">
                                          <b>Total Amount Chargable : </b><br>
                                          (IN WORDS) <br><br>
                                           US DOLLAR FORTY FOUR THOUSAND AND EIGHT HUNDERED ONLY<br><br><br>
                                        </td>
                                        <td>
                                           27.000
                                        </td>
                                        <td>
                                          <b>TOTAL</b>
                                        </td>
                                        <td>
                                          7,155.00
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
                                          Account Name : ARIMA MINERALS <br>Account No : 500100265558241<br> Bank Name : HDFC <br>Branch : RA Puram<br><br>
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
                                       for SB ENGINEERINGS <br><br><br><br>
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
   </body>
</html>