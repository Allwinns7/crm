<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $accounts = "SELECT * FROM `suppliers` ORDER BY name ASC";
   $accounts_exe = $conn->query($accounts);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Manage Suppliers</title>
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
                  <h1>Supplier</h1>
                  <small>Manage Suppliers</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Manage Supplier</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr>
                                       <th>SL.</th>
                                       <th>Supplier Name</th>
                                       <th>Address</th>
                                       <th>Mobile</th>
                                       <!--                                        <th>Debit</th>
                                          <th>Credit</th>-->
                                       <th class="text-right">Balance</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                      $sd=1;
                                      while($all_suppliers = $accounts_exe->fetch_assoc()) { ?>

                                        <tr>
                                           <td><?php echo $sd;?></td>
                                           <td>
                                              <a href="#"><?php echo $all_suppliers['name'];?></a>
                                           </td>
                                           <td><?php echo $all_suppliers['address'];?></td>
                                           <td><?php echo $all_suppliers['mobile'];?></td>
                                           <td class="text-right">
                                              $<?php echo $all_suppliers['balance'];?>                                               
                                           </td>
                                           <!--                                                <td align="right">
                                              </td>
                                              <td align="right">
                                              0.00                                                </td>-->
                                           <td>
                                              <center>
                                                 
                                                    <a href="editsupplier.php?id=<?php echo $all_suppliers['id'];?>" class="btn custom_btn custom_fontcolor btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="" class="deleteSupplier btn btn-danger btn-sm" name="<?php echo $all_suppliers['id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                 
                                              </center>
                                           </td>
                                        </tr>

                                      <?php 
                                        $sd++;
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
        $(".deleteSupplier").click(function ()
          {
              var supplier_id = $(this).attr('name');
              var csrf_test_name = $("[name=csrf_test_name]").val();
              var x = confirm("Are You Sure,Want to Delete ?");
              if (x == true) {
                  $.ajax
                          ({
                              type: "POST",
                              url: 'nb/deletesupplier.php',
                              data: {supplier_id: supplier_id},
                              cache: false,
                              success: function (datas)
                              {

                              }
                          });
              }
          });
         function special_character_remove(vtext, id) {
//                var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\/~`-=";
                var specialChars = "@!#$%^&*()_+[]{}?:;|'`/><";
                var check = function (string) {
                    for (i = 0; i < specialChars.length; i++) {
                        if (string.indexOf(specialChars[i]) > -1) {
                            return true
                        }
                    }
                    return false;
                }
                if (check($('#' + id).val()) == false) {
                    // Code that needs to execute when none of the above is in the string
                } else {
                    alert(specialChars + " these special character are not allows");
                    $("#" + id).val('').focus();
//            $("#customer_name").focus();
                }
            }
         function onlynumber_allow(vtext, id) {
                var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\/~`-=abcdefghijklmnopqrstuvwxyz"
                var check = function (string) {
                    for (i = 0; i < specialChars.length; i++) {
                        if (string.indexOf(specialChars[i]) > -1) {
                            return true
                        }
                    }
                    return false;
                }
                if (check($('#' + id).val()) == false) {
                    // Code that needs to execute when none of the above is in the string
                } else {
                    alert("Special character are not allowed");
                    $("#" + id).val('').focus();
                }
            }
         $('#insert_supplier').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('insert_supplier');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"nb/addsupplier.php",
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
                              $('.resultDiv').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    Supplier Added Successfully!</div>');
                        }
                        else {
                            $('.resultDiv').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Suppliers Failed to Add !</div>');
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