<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $supplier_sql = $conn->query("SELECT * FROM `suppliers` ORDER BY name ASC");
   $category_sql = $conn->query("SELECT * FROM `category` WHERE status=0 ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Products</title>
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
               <div class="row">
                  <div class="col-sm-12">
                     <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add new product</h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="insert_product" name="insert_product" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="row">
                                 <div class="col-sm-5">
                                    <div class="form-group row">
                                       <label for="barcode_or_qrcode" class="col-sm-2 col-form-label">SKU Code <i class="text-danger"></i></label>
                                       <div class="col-sm-4">
                                          <input class="form-control" name="sku_code" type="text" id="sku_code" placeholder="SKU Code" tabindex="1" onkeyup="special_character_remove(this.value, 'product_id')">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label for="product_name" class="col-sm-4 col-form-label">Product Name <i class="text-danger">*</i></label>
                                       <div class="col-sm-8">
                                          <input class="form-control" name="product_name" type="text" id="product_name" placeholder="Product Name" required="" tabindex="1" onkeyup="special_character_remove(this.value, 'product_name')">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-5">
                                    <div class="form-group row">
                                       <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                       <div class="col-sm-4">
                                          <select class="form-control" id="category_id" name="category_id" tabindex="3">
                                             <option value="">Select One</option>
                                             <?php 
                                                while($categories = $category_sql->fetch_assoc()) {
                                                   echo "<option value='".$categories['id']."'>".$categories['name']."</option>";
                                                }
                                             ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="form-group row">
                                       <label for="description" class="col-sm-4 col-form-label">Details</label>
                                       <div class="col-sm-8">
                                          <textarea class="form-control" name="description" id="description" rows="3" placeholder="Details" tabindex="2"></textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="table-responsive" style="margin-top: 10px">
                                 <table class="table table-bordered table-hover">
                                    <thead>
                                       <tr>
                                          <th class="text-center">Quanitty <i class="text-danger">*</i></th>
                                          <th class="text-center">Sell Price <i class="text-danger">*</i></th>
                                          <th class="text-center">Supplier Price <i class="text-danger">*</i></th>
                                          <th class="text-center">Supplier <i class="text-danger">*</i></th>
                                       </tr>
                                    </thead>
                                    <tbody id="form-actions">
                                       <tr class="">
                                          <td class="">
                                             <input class="form-control text-right" name="cartoon_quantity" type="number" required="" placeholder="Product Quantity" tabindex="5" min="0">
                                          </td>
                                          <td class="">
                                             <input class="form-control text-right" name="price" type="number" required="" placeholder="Sell Price" tabindex="6" min="0">
                                          </td>
                                          <td class="">
                                             <input type="number" tabindex="7" class="form-control text-right" name="supplier_price" placeholder="Supplier Price" required="" min="0">
                                          </td>
                                          <td class="text-right">
                                             <select name="supplier_id" class="form-control" required="" tabindex="9">
                                                <option value="">Select One</option>
                                                <?php 
                                                while($suppliers = $supplier_sql->fetch_assoc()) {
                                                   echo "<option value='".$suppliers['id']."'>".$suppliers['name']."</option>";
                                                }
                                             ?>
                                             </select>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-product" class="btn btn-large btn-success" name="add-product" value="Save" tabindex="10">
                                 </div>
                              </div>
                           </div>
                        </form>
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

         $('#insert_product').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_product');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addproduct.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Supplier Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+result.message+' !</div>');
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