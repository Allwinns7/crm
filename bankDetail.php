<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $sid = $_GET['id'];
   $accounts = $conn->query("SELECT * FROM `arm_bank` WHERE `id`=$sid");
   $accounts_exe = $accounts->fetch_assoc();

   $transactions = $conn->query("SELECT * FROM `arm_bank_transaction` WHERE `bank_id`=$sid");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Bank Detail</title>
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
                  <h1>Bank Detail</h1>
                  <small>Bank Detail</small>
               </div>
            </section>
            <div class="content" style="background:#ffffff">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="panel panel-bd lobidrag">
                       <div class="panel-heading">
                          <div class="panel-title" style="display: flex; align-content: center; justify-content: space-between;">
                             <h4>Bank Ledger</h4>
                          </div>
                       </div>
                       <div class="panel-body">
                          <div id="printableArea" style="margin-left:2px;">
                             <div class="text-center">
                                <h3><?php echo $accounts_exe['bank_name'];?></h3>
                                <h5>A/C Name : <?php echo $accounts_exe['ac_name'];?></h5>
                                <h5>A/C Number : <?php echo $accounts_exe['ac_no'];?></h5>
                                <h5>Branch : <?php echo $accounts_exe['branch'];?></h5>
                                <span> Print Date: <?php echo date('d/m/Y h:i:s');?></span>
                             </div>
                             <div class="table-responsive" style="margin-top: 10px;">
                                <table id="" class="table table-bordered table-striped table-hover">
                                   <thead>
                                      <tr>
                                         <th class="text-center">S.No</th>
                                         <th class="text-center">Date</th>
                                         <th class="text-center">Description</th>
                                         <th class="text-center">Withdraw / Deposite ID</th>
                                         <th class="text-right">Debit (-)</th>
                                         <th class="text-right">Credit (+)</th>
                                         <th class="text-right">Balance</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                    <?php 
                                      $all_deb = 0;
                                      $all_cre = 0;
                                      $inc = 1;


                                      $currency_icon='';
                                        if($accounts_exe['currency']=='USD'){
                                          $currency_icon = '&#36;';
                                        }
                                        else if($accounts_exe['currency']=='INR') {
                                          $currency_icon = '&#8377;';
                                        }
                                        else {
                                          $currency_icon = '&#1583;.&#1573;';
                                        }

                                      while($all_trans = $transactions->fetch_assoc()){ 
                                        $all_cre += $all_trans['credit'];
                                        $all_deb += $all_trans['debit'];
                                        ?>
                                        <tr>
                                          <td align="center"><?php echo $inc;?></td>
                                          <td align="center"><?php echo $all_trans['transaction_date'];?></td>
                                          <td align="center"><?php echo $all_trans['description'];?></td>
                                          <td align="center"><?php echo $all_trans['ref_id'];?></td>
                                          <td align="right"><?php echo  $currency_icon.$all_trans['debit'];?> </td>
                                          <td align="right"><?php echo  $currency_icon.$all_trans['credit'];?></td>
                                          <td align="right"><?php echo  $currency_icon.$all_trans['closing'];?></td>
                                      </tr>
                                      <?php
                                        $inc++;
                                      }
                                    ?>
                                   </tbody>
                                   <tfoot>
                                      <tr>
                                         <td colspan="4" align="right"><b>Grand Total:</b></td>
                                         <td align="right"><b><?php echo $currency_icon.$all_deb;?></b></td>
                                         <td align="right"><b><?php echo $currency_icon.$all_cre;?></b></td>
                                         <td align="right"><b><?php echo $currency_icon.$accounts_exe['balance'];?></b></td>
                                      </tr>
                                   </tfoot>
                                </table>
                             </div>
                          </div>
                          <div class="text-center">
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