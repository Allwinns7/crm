<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include('includes/auth.inc'); 
  include('database_connection.php');

  $statement = $connect->prepare("
    SELECT * FROM arm_quote ORDER BY id ASC
  ");

  $statement->execute();

  $all_result = $statement->fetchAll();

  $total_rows = $statement->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | All Quotation</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
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
                  <i class="fa fa-file-text"></i>
               </div>
               <div class="header-title">
                  <h1>Quotation</h1>
                  <small>All Quotation</small>
               </div>
            </section>
            <div class="content" style="background:#ffffff">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Quotations</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="qte.php" class="btn btn-add"><i class="fa fa-plus"></i> New Quotation</a> 
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Quote No.</th>
                                       <th>Quote Date</th>
                                       <th>Receiver Name</th>
                                       <th>Receiver Email</th>
                                       <th>Send</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                      if($total_rows > 0)
                                      {
                                        foreach($all_result as $row)
                                        {
                                          echo '
                                            <tr>
                                              <td>'.$row["id"].'</td>
                                              <td>'.$row["order_date"].'</td>
                                              <td>'.$row["order_receiver_name"].'</td>
                                              <td>'.$row["order_receiver_email"].'</td>
                                              <td><a href="test.php?id='.$row["id"].'">Create Proforma</a></td>
                                              <td>
                                                <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a href="vqte.php?id='.$row["id"].'"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                <a href="#" id="'.$row["id"].'" class="delete"><span class="glyphicon glyphicon-remove"></span></a>
                                              </td>
                                            </tr>
                                          ';
                                        }
                                      }
                                      ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
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
         $(document).ready(function(){
         $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
           swal({
              title: "Are you sure?",
              text: "Do you want to delete this Invoice !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deleteinvoice.php',
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
                             text: "Invoice Deleted successfully!!!",
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
                             text: "Failed to delete Invoice details!!",
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
          });
      });
      </script>
   </body>
</html>