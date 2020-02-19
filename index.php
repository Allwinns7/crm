<?php
   include('includes/auth.inc');
   include('backend/conn.php');

   $order_sql = $conn->query("SELECT * FROM tbl_order WHERE order_converted=1");
   $order_count = mysqli_num_rows($order_sql);

   $oppr_sql = $conn->query("SELECT * FROM accounts ");
   $oppr_count = mysqli_num_rows($oppr_sql);

   $lead_sql = $conn->query("SELECT * FROM products");
   $lead_count = mysqli_num_rows($lead_sql);

   $invc_sql = $conn->query("SELECT * FROM suppliers");
   $invc_count = mysqli_num_rows($invc_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM Dashboard</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
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
                  <i class="fa fa-dashboard"></i>
               </div>
               <div class="header-title">
                  <h1>CRM Admin Dashboard</h1>
                  <small>Very detailed & featured admin.</small>
               </div>
            </section>
            <section class="content">
   <!-- Alert Message -->
   <!-- First Counter -->
   <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <!--<canvas class="totalCustomer"></canvas>-->
                  <div class="small">Total Customer</div>
                  <h2 style="float: left;">
                     <span class="count-number"><?php echo $oppr_count;?></span>
                     <span class="slight"><i class="fa fa-play fa-rotate-270 text-primary"> </i></span>
                  </h2>
                  <span>
                  <img src="https://wholesalenew.bdtask.com/newholesale/assets/dist/img/customer.png" style="width: 25%; float: right;">
                  </span>
                  <!--<div class="small">Total Customer</div>-->
                  <!--<div class="sparkline1 text-center"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <!--<canvas class="totalProduct"></canvas>-->
                  <div class="small">Total Product</div>
                  <h2 style="float: left;">
                     <span class="count-number"><?php echo $lead_count;?></span> 
                     <span class="slight"><i class="fa fa-play fa-rotate-270 text-primary"> </i></span>
                  </h2>
                  <span>
                  <img src="https://wholesalenew.bdtask.com/newholesale/assets/dist/img/products-icon-3.jpg" style="width: 25%; float: right;">
                  </span>
                  <!--<div class="small">Total Product</div>-->
                  <!--<div class="sparkline1 text-center"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <!--<canvas class="totalSupplier"></canvas>-->
                  <div class="small">Total Supplier</div>
                  <h2 style="float: left;">
                     <span class="count-number"><?php echo $invc_count;?></span> 
                     <span class="slight"><i class="fa fa-play fa-rotate-270 text-primary"> </i> </span>
                  </h2>
                  <span>
                  <img src="https://wholesalenew.bdtask.com/newholesale/assets/dist/img/supplier.png" style="width: 35%; float: right;">
                  </span>
                  <!--<div class="small">Total Supplier</div>-->
                  <!--<div class="sparkline1 text-center"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <!--                              <canvas class="totalInvoice"></canvas>-->
                  <div class="small">Total Invoice</div>
                  <h2 style="float: left;">
                     <span class="count-number"><?php echo $order_count;?></span>
                     <span class="slight"> <i class="fa fa-play fa-rotate-270 text-primary"> </i> </span>
                  </h2>
                  <span>
                  <img src="https://wholesalenew.bdtask.com/newholesale/assets/dist/img/invoice.png" style="width: 25%; float: right;">
                  </span>
                  <!--<div class="small">Total Invoice</div>-->
                  <!--<div class="sparkline1 text-center"></div>-->
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Second Counter -->
   <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;">
                     <img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/pos_invoice.png" height="40" width="40">
                     </span>
                  </h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Cinvoice/pos_invoice')">Create POS Invoice</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/invoice.png" height="45" width="45"> </span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Cinvoice')">Create New Invoice</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/product.png" height="45" width="45"> </span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascipt:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Cproduct')">Add Product</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/customer.png" height="45" width="45"> </span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Ccustomer')">Add Customer</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Third Counter -->
   <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/sale.png" height="45" width="45"> </span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Admin_dashboard/todays_sales_report')">Sales Report</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/purchase.png" height="45" width="45"> </span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Admin_dashboard/todays_purchase_report')">Purchase Report</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/stock.png" height="40"> </span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Creport')">Stock Report</a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="panel panel-bd">
            <div class="panel-body">
               <div class="statistic-box">
                  <h2><span class="slight" style="margin-left: 70px;"><img src="https://wholesalenew.bdtask.com/newholesale/my-assets/image/account.png" height="40"></span></h2>
                  <div class="small" style="font-size: 17px;margin-top: 20px;text-align: center;"><a href="javascript:void(0)" onclick="pageopen('https://wholesalenew.bdtask.com/newholesale/Admin_dashboard/all_report')">Todays Report</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--<hr>-->
   <!--            <div class="row">
      This month progress 
      <div class="col-sm-12 col-md-8">
         <div class="panel panel-bd">
             <div class="panel-heading">
                 <div class="panel-title">
                     <h4> Monthly Progress Report</h4>
                 </div>
             </div>
             <div class="panel-body">
                 <canvas id="lineChart" height="142"></canvas>
             </div>
         </div>
      </div>
      
      </div>-->
   <!--<hr>-->
</section>
            <section class="content">
               <div class="row">
                  <div class="col-xs-12 col-sm-8">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Upcoming Events</h4>
                           </div>
                        </div>
                        <div class="panel-body" id="cal_list">
                           
                           
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-4">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                               <h4>Todays Report</h4>
                            </div>
                         </div>
                         <div class="panel-body">
                            <div class="message_innerx">
                               <div class="message_widgets">
                                  <table class="table table-bordered table-striped table-hover">
                                     <tbody>
                                        <tr>
                                           <th>Todays Report</th>
                                           <th>TK</th>
                                        </tr>
                                        <tr>
                                           <th>Total Sales</th>
                                           <td>$ 9,000.00</td>
                                        </tr>
                                        <tr>
                                           <th>Total Purchase</th>
                                           <td>$ 0.00</td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </div>
                            </div>
                            <h4 style="font-size: 13px;">Last Month Sales &amp; Purchase</h4>
                            <div class="flotChart" style="height:200px">
                               <div id="flotChart8" class="flotChart-demo" style="padding: 0px; position: relative;">
                                  <img src="assets/report.png" />
                                  <div class="legend">
                                     <div style="position: absolute; width: 137px; height: 32px; top: 5px; right: 5px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div>
                                     <table style="position:absolute;top:5px;right:5px;;font-size:smaller;color:#545454">
                                        <tbody>
                                           <tr>
                                              <td class="legendColorBox">
                                                 <div style="border:1px solid #ccc;padding:1px">
                                                    <div style="width:4px;height:0;border:5px solid #003366;overflow:hidden"></div>
                                                 </div>
                                              </td>
                                              <td class="legendLabel">Sales 293,277,803.00</td>
                                           </tr>
                                           <tr>
                                              <td class="legendColorBox">
                                                 <div style="border:1px solid #ccc;padding:1px">
                                                    <div style="width:4px;height:0;border:5px solid #86b4e2;overflow:hidden"></div>
                                                 </div>
                                              </td>
                                              <td class="legendLabel">Purchase 3,334,582.00</td>
                                           </tr>
                                        </tbody>
                                     </table>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                        
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Accounts</h4>
                           </div>
                        </div>
                        <div class="panel-body" id="accounts_list">
                     
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Contacts</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="Workslist">
                              <div class="worklistdate">
                                 <table class="table table-hover">
                                    <thead>
                                       <tr>
                                          <th>Contact Name</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                       </tr>
                                    </thead>
                                    <tbody id="contact_list">
                                       
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Leads</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="Workslist">
                              <div class="worklistdate">
                                 <table class="table table-hover">
                                    <thead>
                                       <tr>
                                          <th>Name</th>
                                          <th>Accounts</th>
                                          <th>Status</th>
                                          <th>View</th>
                                       </tr>
                                    </thead>
                                    <tbody id="leads_list">
                                    
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Opportunity</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="Workslist">
                              <div class="worklistdate">
                                 <table class="table table-hover">
                                    <thead>
                                       <tr>
                                          <th>Name</th>
                                          <th>Stage</th>
                                          <th>Source</th>
                                       </tr>
                                    </thead>
                                    <tbody id="opps_list">
                                       
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
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
      <script src="assets/plugins/counterup/waypoints.js" type="text/javascript"></script>
      <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
      <script src="assets/plugins/monthly/monthly.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
       <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
         $(document).ready(function(){

            // Getting all contact details
            $.ajax({
               url: 'backend/getallcontacts.php',
               type: 'GET',
               async:false,
               success: function(data){
                   var result = JSON.parse(data);
                   var list = "";
                   for(var ls=0; ls<result.length;ls++) {
                        list += "<tr><th scope='row'>"+(ls+1)+". "+result[ls].name+"</th><td>"+result[ls].email+"</td><td>"+result[ls].phone+"</td></tr>";
                   }
                   list +="<tr><th></th><td></td><td><a class='pull-right' href='contacts.php'>View More</a></td></tr>";
                  $('#contact_list').html(list);
               },
               error: function(xhr, textStatus, errorThrown) {
                   alert('Network Error, Try Later!!');
                   return false;
               }
             });

             // Getting all accounts details 

             $.ajax({
               url: 'backend/getallaccounts.php',
               type: 'GET',
               async:false,
               success: function(data){
                   var result = JSON.parse(data);
                   var list = "";
                   for(var ls=0; ls<result.length;ls++) {
                        list += "<div class='Pendingwork'><span class='label-success label label-default pull-right'><a href='account_detail.php?id="+result[ls].id+"'>View</a></span>"+
                                    "<a href='#'>"+(ls+1)+". "+result[ls].name+"</a>"+ 
                                    "<div class='upworkdate'>"+
                                       "<p>"+result[ls].industry+"</p>"+
                                    "</div>"+
                                 "</div>";
                   }
                   list +="<a class='pull-right' href='account.php'>View More</a>";
                  $('#accounts_list').html(list);
               },
               error: function(xhr, textStatus, errorThrown) {
                   alert('Network Error, Try Later!!');
                   return false;
               }
             });


             $.ajax({
               url: 'backend/getallleads.php',
               type: 'GET',
               async:false,
               success: function(data){
                   var result = JSON.parse(data);
                   var lds = "";
                   for(var ls=0; ls<result.length;ls++) {
                        lds += "<tr>"+
                                    "<td>"+(ls+1)+". "+result[ls].name+"</td>"+
                                    "<td>"+result[ls].acc+"</td>"+
                                    "<td>"+result[ls].statuses+"</td>"+
                                    "<td><a href='leads_detail.php?id="+result[ls].id+"'>View</a></td>"+
                                 "</tr>";
                   }
                   lds +="<tr><td></td><td></td><td></td><td><a class='pull-right' href='leads.php'>View More</a></td></tr>";
                  $('#leads_list').html(lds);
               },
               error: function(xhr, textStatus, errorThrown) {
                   alert('Network Error, Try Later!!');
                   return false;
               }
             });

             $.ajax({
               url: 'backend/getalloppors.php',
               type: 'GET',
               async:false,
               success: function(data){
                   var result = JSON.parse(data);
                   var list = "";
                   for(var ls=0; ls<result.length;ls++) {
                        list += "<tr>"+
                                    "<td>"+(ls+1)+". "+result[ls].name+"</td>"+
                                    "<td>"+result[ls].stage+"</td>"+
                                    "<td>"+result[ls].source+"</td>"+
                                 "</tr>";
                   }
                   list +="<tr><td></td><td></td><td><a class='pull-right' href='oppurtunity.php'>View More</a></td></tr>";
                  $('#opps_list').html(list);
               },
               error: function(xhr, textStatus, errorThrown) {
                   alert('Network Error, Try Later!!');
                   return false;
               }
             });

             $.ajax({
               url: 'backend/getallevents.php',
               type: 'GET',
               async:false,
               success: function(data){
                   var result = JSON.parse(data);
                   var list = "";
                   for(var ls=0; ls<result.length;ls++) {
                        list += "<div class='work-touchpoint'>"+
                                 "<div class='work-touchpoint-date'>"+
                                    "<span class='day'>"+result[ls].day+"</span>"+
                                    "<span class='month'>"+result[ls].month+"</span>"+
                                 "</div>"+
                                 "</div>"+
                                 "<div class='detailswork'>"+
                                    "<span class='label-custom label label-default pull-right'>"+result[ls].message+"</span>"+
                                    "<a href='#' title='headings'>"+result[ls].message+"</a> <br>"+
                                    "<p>"+result[ls].location+"</p>"+
                                 "</div>";
                   }
                    list +="<a class='pull-right' href='event.php'>View More</a>";
                   
                  $('#cal_list').html(list);
               },
               error: function(xhr, textStatus, errorThrown) {
                   alert('Network Error, Try Later!!');
                   return false;
               }
             });

         });
         function dash() {
             $('#m_calendar').monthly({
                 mode: 'event',
                 xmlUrl: 'events.xml'
             }); 
             $('.count-number').counterUp({
                 delay: 10,
                 time: 5000
             });
         }
         dash();         
      </script>
   </body>
</html>