<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $accounts = "SELECT * FROM `category` ORDER BY name ASC";
   $accounts_exe = $conn->query($accounts);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Category</title>
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
         .modal.right .modal-dialog,
         .modal.left .modal-dialog {
      position: fixed;
      margin: auto;
      width: 600px;
      height: 100%;
      -webkit-transform: translate3d(0%, 0, 0);
          -ms-transform: translate3d(0%, 0, 0);
           -o-transform: translate3d(0%, 0, 0);
              transform: translate3d(0%, 0, 0);
   }

   .modal.right .modal-content,
   .modal.left .modal-content {
      height: 100%;
      background: #ececec;
      overflow-y: auto;
}
   .modal.right .modal-body,
   .modal.left .modal-body {
      padding: 15px 15px 80px;
      background: #fff;
   }

        
/*Right*/
   .modal.right.fade .modal-dialog,
   .modal.left.fade .modal-dialog {
      right: -320px;
      -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
         -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
           -o-transition: opacity 0.3s linear, right 0.3s ease-out;
              transition: opacity 0.3s linear, right 0.3s ease-out;
   }
   
   .modal.right.fade.in .modal-dialog,
   .modal.left.fade.in .modal-dialog {
      right: 0;
   }
   .modal-footer{
      background: #fff;
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
                  <h1>Category</h1>
                  <small>Add Category Details</small>
               </div>
            </section>
            <section class="content">
               <!-- Alert Message -->
               <!-- New customer -->
               <div class="row">
                  <div class="col-sm-12">
                    <div class="resultDiv"></div>
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add Category </h4>
                           </div>
                        </div>
                        <form action="#" class="form-vertical" id="insert_category" method="post" accept-charset="utf-8">
                           <div class="panel-body">
                              <div class="form-group row">
                                 <label for="category_name" class="col-sm-3 col-form-label">Category Name <i class="text-danger">*</i></label>
                                 <div class="col-sm-6">
                                    <input class="form-control" name="category_name" id="category_name" type="text" placeholder="Category Name" required="" tabindex="1" onkeyup="special_character_remove(this.value, 'category_name')">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-customer" class="btn custom_btn custom_fontcolor btn-large" name="add-customer" value="Save">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Category</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th class="text-center">SL.</th>
                                       <th class="text-center">Category Name</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                    $ct =1 ;
                                    while($categories = $accounts_exe->fetch_assoc()) { ?>

                                        <tr>
                                         <td class="text-center"><?php echo $ct;?></td>
                                         <td class="text-center"><?php echo $categories['name'];?></td>
                                         <td>
                                            <center>
                                                  <a href="editcategory.php?id=<?php echo $categories['id'];?>" class="btn custom_btn custom_fontcolor btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                  <a href="" class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $categories['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                         </td>
                                      </tr>

                                    <?php
                                    $ct++;
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
        $(".DeleteCategory").click(function ()
          {
              var supplier_id = $(this).attr('name');
              var x = confirm("Are You Sure,Want to Delete ?");
              if (x == true) {
                  $.ajax
                          ({
                              type: "POST",
                              url: 'nb/deletecategory.php',
                              data: {supplier_id: supplier_id},
                              cache: false,
                              success: function (datas)
                              {

                              }
                          });
              }
          });
         $('#insert_category').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_category');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addcategory.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        console.log(result);
                        if(result.status=='success') {
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Category Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Category Failed to Add !</div>');
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