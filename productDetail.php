<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $pid= $_GET['id'];
   $purchase_sql = $conn->query("SELECT SUM(`quantity`) as tquantity FROM `arm_purchase_item` WHERE `product_id`=$pid");
   $purchase_detail = $purchase_sql->fetch_assoc();

   $sales_sql = $conn->query("SELECT SUM(`quantity`) as tquantity FROM `arm_sales_item` WHERE `product_id`=$pid");
   $sales_detail = $sales_sql->fetch_assoc();

   $product_sql = $conn->query("SELECT * FROM `products` WHERE `id`=$pid");
   $products_detail = $product_sql->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Product Details</title>
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
                  <h1>Products</h1>
                  <small>Products Details</small>
               </div>
            </section>
            <section class="content">
			   <!-- Alert Message -->
			   <div class="row">
			      <div class="col-sm-12">
			         <div class="panel panel-bd lobidrag">
			            <div class="panel-heading">
			               <div class="panel-title">
			                  <h4>Product Details </h4>
			               </div>
			            </div>
			            <div class="panel-body">
			               <h2> <span style="font-weight:normal;">Product Name: </span><span style="color:#005580;"><?php echo $products_detail['name'];?></span></h2>
			               <h4> <span style="font-weight:normal;">SKU:</span> <span style="color:#005580;"><?php echo $products_detail['sku'];?></span></h4>
			               <h4> <span style="font-weight:normal;">Price:</span><span style="color:#005580;"> 
			                  $ <?php echo $products_detail['supplier_price'];?></span>
			               </h4>
			               <table class="table">
			                  <tbody>
			                     <tr>
			                        <th>Total Purchase = <span style="color:#ff0000;"><?php echo $purchase_detail['tquantity'] ?: 0;?></span></th>
			                        <th>Total Sales = <span style="color:#ff0000;"> <?php echo $sales_detail['tquantity'] ?: 0;?></span></th>
			                        <th>Stock = <span style="color:#ff0000;"> <?php echo $products_detail['quantity'] ?: 0;?></span></th>
			                     </tr>
			                  </tbody>
			               </table>
			            </div>
			         </div>
			      </div>
			   </div>
			   <!-- Total Purchase report -->
			   <div class="row">
			      <div class="col-sm-12">
			         <div class="panel panel-bd lobidrag">
			            <div class="panel-heading">
			               <div class="panel-title">
			                  <h4>Purchase Report </h4>
			               </div>
			            </div>
			            <div class="panel-body">
			               <div class="table-responsive">
			                  <div id="dataTableExample2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			                     <table id="dataTableExample2" class="table table-bordered table-striped table-hover dataTable" role="grid">
			                        <thead>
			                           <tr role="row">
			                              <th class="sorting_asc" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending" style="width: 193px;">Date</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-label="Sell No: activate to sort column ascending" style="width: 136px;">Sell No</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-label="Supplier Name: activate to sort column ascending" style="width: 240px;">Supplier Name</th>
			                              <th class="text-center sorting" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-label="Carton: activate to sort column ascending" style="width: 130px;">Carton</th>
			                              <th class="text-center sorting" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 160px;">Quantity</th>
			                              <th class="text-right sorting" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-label="Rate: activate to sort column ascending" style="width: 156px;">Rate</th>
			                              <th style="text-align: right; width: 225px;" class="sorting" tabindex="0" aria-controls="dataTableExample2" rowspan="1" colspan="1" aria-label="Total Amount: activate to sort column ascending">Total Amount</th>
			                           </tr>
			                        </thead>
			                        <tbody>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2019 - DEC - 23</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cpurchase/purchase_details_data/20191219194029">
			                                 122121
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Csupplier/supplier_details/Z7M61FFBI8HT1NQKPJTU">Dexter Inc</a>
			                              </td>
			                              <td class="text-center">1</td>
			                              <td class="text-center">100</td>
			                              <td class="text-right">$ 450</td>
			                              <td style="text-align:right;"> $ 45000</td>
			                           </tr>
			                           <tr role="row" class="even">
			                              <td class="sorting_1">2019 - NOV - 06</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cpurchase/purchase_details_data/20191106054045">
			                                 f4614
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Csupplier/supplier_details/Z7M61FFBI8HT1NQKPJTU">Dexter Inc</a>
			                              </td>
			                              <td class="text-center">100</td>
			                              <td class="text-center">10000</td>
			                              <td class="text-right">$ 450</td>
			                              <td style="text-align:right;"> $ 4500000</td>
			                           </tr>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2020 - FEB - 08</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cpurchase/purchase_details_data/20200208165720">
			                                 000000765
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Csupplier/supplier_details/Z7M61FFBI8HT1NQKPJTU">Dexter Inc</a>
			                              </td>
			                              <td class="text-center">1</td>
			                              <td class="text-center">100</td>
			                              <td class="text-right">$ 450</td>
			                              <td style="text-align:right;"> $ 45000</td>
			                           </tr>
			                           <tr role="row" class="even">
			                              <td class="sorting_1">2020 - JAN - 14</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cpurchase/purchase_details_data/20200114180330">
			                                 2021
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Csupplier/supplier_details/Z7M61FFBI8HT1NQKPJTU">Dexter Inc</a>
			                              </td>
			                              <td class="text-center">1</td>
			                              <td class="text-center">100</td>
			                              <td class="text-right">$ 450</td>
			                              <td style="text-align:right;"> $ 45000</td>
			                           </tr>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2020 - JAN - 17</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cpurchase/purchase_details_data/20200117110158">
			                                 585848
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Csupplier/supplier_details/Z7M61FFBI8HT1NQKPJTU">Dexter Inc</a>
			                              </td>
			                              <td class="text-center">6</td>
			                              <td class="text-center">600</td>
			                              <td class="text-right">$ 450</td>
			                              <td style="text-align:right;"> $ 270000</td>
			                           </tr>
			                        </tbody>
			                        <tfoot>
			                           <tr>
			                              <td colspan="3" style="text-align:right;" rowspan="1"><b>Total Cartoon</b></td>
			                              <td rowspan="1" colspan="1"> 109</td>
			                              <td rowspan="1" colspan="1"></td>
			                              <td style="text-align:right;" rowspan="1" colspan="1"><b>Grand Total</b></td>
			                              <td style="text-align:right;" rowspan="1" colspan="1"><b> $ 4,911,480.00</b></td>
			                           </tr>
			                        </tfoot>
			                     </table>
			                  </div>
			               </div>
			            </div>
			         </div>
			      </div>
			   </div>
			   <!--Total sales report -->
			   <div class="row">
			      <div class="col-sm-12">
			         <div class="panel panel-bd lobidrag">
			            <div class="panel-heading">
			               <div class="panel-title">
			                  <h4>Sales Report </h4>
			               </div>
			            </div>
			            <div class="panel-body">
			               <div class="table-responsive">
			                  <div id="dataTableExample3_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			                     <table id="dataTableExample3" class="table table-bordered table-striped table-hover dataTable" role="grid">
			                        <thead>
			                           <tr role="row">
			                              <th class="sorting_asc" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending" style="width: 134px;">Date</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Sell No: activate to sort column ascending" style="width: 104px;">Sell No</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 184px;">Customer Name</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Carton: activate to sort column ascending" style="width: 88px;">Carton</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 110px;">Quantity</th>
			                              <th class="sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Rate: activate to sort column ascending" style="width: 66px;">Rate</th>
			                              <th style="text-align: right; width: 158px;" class="sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Total Amount: activate to sort column ascending">Total Amount</th>
			                              <th class="text-right sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Total Discount: activate to sort column ascending" style="width: 168px;">Total Discount</th>
			                              <th class="text-right sorting" tabindex="0" aria-controls="dataTableExample3" rowspan="1" colspan="1" aria-label="Invoice Total: activate to sort column ascending" style="width: 150px;">Invoice Total</th>
			                           </tr>
			                        </thead>
			                        <tbody>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2019 - DEC - 31</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/3174488457">
			                                 3174488457
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/2PF1RUX1PP78GHE">Md Samiul Alam</a>
			                              </td>
			                              <td class="text-right">1</td>
			                              <td class="text-right">100</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 50000</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 50000</td>
			                           </tr>
			                           <tr role="row" class="even">
			                              <td class="sorting_1">2019 - NOV - 06</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/4938751784">
			                                 4938751784
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/58UV4M8YP4UYGTG">William</a>
			                              </td>
			                              <td class="text-right">5</td>
			                              <td class="text-right">500</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 250000</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 3150000</td>
			                           </tr>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2019 - NOV - 06</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/9884886818">
			                                 9884886818
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/58UV4M8YP4UYGTG">William</a>
			                              </td>
			                              <td class="text-right">10</td>
			                              <td class="text-right">1000</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 500000</td>
			                              <td class="text-right"> $ 10100</td>
			                              <td class="text-right"> $ 3349900</td>
			                           </tr>
			                           <tr role="row" class="even">
			                              <td class="sorting_1">2020 - JAN - 11</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/5523733652">
			                                 5523733652
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/8Q3OM5LXN7SFZP3">uhlòoil</a>
			                              </td>
			                              <td class="text-right">0</td>
			                              <td class="text-right">0</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 0</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 0</td>
			                           </tr>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2020 - JAN - 15</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/3836518952">
			                                 3836518952
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/UITJA7HYEEWSCQ1">Malith</a>
			                              </td>
			                              <td class="text-right">10</td>
			                              <td class="text-right">1000</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 500000</td>
			                              <td class="text-right"> $ 5000</td>
			                              <td class="text-right"> $ 545000</td>
			                           </tr>
			                           <tr role="row" class="even">
			                              <td class="sorting_1">2020 - JAN - 15</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/4224781556">
			                                 4224781556
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/58UV4M8YP4UYGTG">William</a>
			                              </td>
			                              <td class="text-right">2</td>
			                              <td class="text-right">200</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 100000</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 100000</td>
			                           </tr>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2020 - JAN - 16</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/6561956822">
			                                 6561956822
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/SV1NC2HLG7V53T2">AA</a>
			                              </td>
			                              <td class="text-right">1</td>
			                              <td class="text-right">100</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 50000</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 50000</td>
			                           </tr>
			                           <tr role="row" class="even">
			                              <td class="sorting_1">2020 - JAN - 25</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/9885855729">
			                                 9885855729
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/3ILCNWIVSZPXRCD">abc</a>
			                              </td>
			                              <td class="text-right">1</td>
			                              <td class="text-right">100</td>
			                              <td class="text-right"> $ 500</td>
			                              <td style="text-align:right;"> $ 50000</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 140200</td>
			                           </tr>
			                           <tr role="row" class="odd">
			                              <td class="sorting_1">2020 - JAN - 28</td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Cinvoice/invoice_inserted_data/6251235997">
			                                 6251235997
			                                 </a>
			                              </td>
			                              <td>
			                                 <a href="https://wholesalenew.bdtask.com/newholesale/Ccustomer/customer_ledger/2PF1RUX1PP78GHE">Md Samiul Alam</a>
			                              </td>
			                              <td class="text-right">0</td>
			                              <td class="text-right">0</td>
			                              <td class="text-right"> $ 1700</td>
			                              <td style="text-align:right;"> $ 0</td>
			                              <td class="text-right"> $ 0</td>
			                              <td class="text-right"> $ 0</td>
			                           </tr>
			                        </tbody>
			                        <tfoot>
			                           <tr>
			                              <td colspan="3" style="text-align:right;" rowspan="1"><b>Total Cartoon</b></td>
			                              <td class="text-right" rowspan="1" colspan="1">30</td>
			                              <td rowspan="1" colspan="1"></td>
			                              <td rowspan="1" colspan="1"></td>
			                              <td rowspan="1" colspan="1"></td>
			                              <td rowspan="1" colspan="1"><b>Grand Total</b></td>
			                              <td style="text-align:right;" rowspan="1" colspan="1"><b> $ 7,385,100.00</b></td>
			                           </tr>
			                        </tfoot>
			                     </table>
			                     <div class="dataTables_paginate paging_simple_numbers" id="dataTableExample3_paginate">
			                        <ul class="pagination">
			                           <li class="paginate_button previous disabled" id="dataTableExample3_previous"><a href="#" aria-controls="dataTableExample3" data-dt-idx="0" tabindex="0">Previous</a></li>
			                           <li class="paginate_button active"><a href="#" aria-controls="dataTableExample3" data-dt-idx="1" tabindex="0">1</a></li>
			                           <li class="paginate_button next disabled" id="dataTableExample3_next"><a href="#" aria-controls="dataTableExample3" data-dt-idx="2" tabindex="0">Next</a></li>
			                        </ul>
			                     </div>
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
   </body>
</html>