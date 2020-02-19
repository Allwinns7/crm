<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $products_sql = $conn->query("SELECT * FROM `arm_bank` ORDER BY bank_name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Manage Bank</title>
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
                  <h1>Manage Bank</h1>
                  <small>Manage Your Bank</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Bank</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th>SL.</th>
                                       <th>Bank Name</th>
                                       <th>Currency</th>
                                       <th>A/C Name</th>
                                       <th>A/C Number</th>
                                       <th>Branch</th>
                                       <th>Balance</th>
                                       <th style="text-align: center; width : 130px">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php    
                                       $pds =1;
                                       while($products = $products_sql->fetch_assoc()) {
                                        $currency_icon='';
                                        if($products['currency']=='USD'){
                                          $currency_icon = '&#36;';
                                        }
                                        else if($products['currency']=='INR') {
                                          $currency_icon = '&#8377;';
                                        }
                                        else {
                                          $currency_icon = '&#1583;.&#1573;';
                                        }
                                       ?>
                                          <tr>
                                             <td><?php echo $pds;?></td>
                                             <td>
                                                <a href="bankDetail.php?id=<?php echo $products['id'];?>">
                                                <?php echo $products['bank_name'];?>
                                                </a>        
                                             </td>
                                             <td><?php echo $products['currency'];?></td>
                                             <td><?php echo $products['ac_name'];?></td>
                                             <td><?php echo $products['ac_no'];?></td>
                                             <td><?php echo $products['branch'];?></td>
                                             <td><?php echo $currency_icon.$products['balance'];?></td>
                                             <td>
                                                <center>
                                                      <a href="editbank.php?id=<?php echo $products['id'];?>" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                      <a href="" class="deleteProduct btn btn-danger btn-xs" name="<?php echo $products['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </center>
                                             </td>
                                          </tr>
                                       <?php
                                       $pds++;
                                       }
                                    ?>                                   
                                 </tbody>
                              </table>
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
          $(".deleteProduct").click(function ()
          {
            var supplier_id = $(this).attr('name');
            var csrf_test_name = $("[name=csrf_test_name]").val();
            var x = confirm("Are You Sure,Want to Delete ?");
            if (x == true) {
                $.ajax
                  ({
                      type: "POST",
                      url: 'nb/deletebank.php',
                      data: {supplier_id: supplier_id},
                      cache: false,
                      success: function (datas)
                      {

                      }
                  });
              }
          });
         $('#insert_product').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_product');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/updateproduct.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Product Updated Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Product Failed to Add !</div>');
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
      </script>
   </body>
</html>