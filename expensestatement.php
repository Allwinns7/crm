<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $banks_sql = $conn->query("SELECT * FROM `arm_bank` ORDER BY bank_name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Expense Statement</title>
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
                  <h1>Expense Statements</h1>
                  <small>View Statements</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                    <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                       <div class="panel-heading">
                          <div class="panel-title">
                             <h4>Expense Statement </h4>
                          </div>
                       </div>
                       <div class="panel-body">
                          <form action="#" class="form-inline" method="get" id="getstatement" accept-charset="utf-8">
                             <div class="form-group">
                                <label class="" for="from_date" style="margin: 4px;">Start Date</label>
                                <input type="text" name="from_date" class="form-control" id="from_date" placeholder="Start Date" value="">
                             </div>
                             <div class="form-group">
                                <label class="" for="end_date" style="margin: 4px;">End Date</label>
                                <input type="text" name="end_date" class="form-control" id="end_date" placeholder="End Date" value="">
                             </div>
                             <button type="button" class="btn custom_btn custom_fontcolor" onclick="statementResults()">Search</button>
                             <!--<a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')">Print</a>-->
                          </form>
                       </div>
                    </div>
                  </div>
               </div>
               <div class="row">
                 <div class="col-sm-12">
                    <div class="results">

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
      <script type="text/javascript">
            $(document).ready(function(){
               $("#from_date").datepicker({dateFormat: 'yy-mm-dd'});
               $("#end_date").datepicker({dateFormat: 'yy-mm-dd'});
            });
            function statementResults() {
              var from_date = $("#from_date").val();
              var end_date = $("#end_date").val();
              if (from_date) {
                  if (!end_date) {
                      alert("End date must be required!");
                      $("#end_date").focus();
                      return false;
                  }
              }
              $.ajax({
                  url: "nb/statement_result.php",
                  type: "POST",
                  data: {from_date: from_date, end_date: end_date},
                  success: function (r) {
      //               console.log(r);
                      $(".results").html(r);
                      $("#loaded_img").show();
                      setTimeout(function () {
                          $("#loaded_img").hide();
                      }, 500);
                  }
              });
          }
      </script>
   </body>
</html>