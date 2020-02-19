<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $accounts = "SELECT * FROM `oppurtunity` ORDER BY name ASC";
   $accounts_exe = $conn->query($accounts);

   $select_account = "SELECT * FROM `accounts` ORDER BY `name` ASC";
   $select_acc_exe = $conn->query($select_account);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Oppurtunity</title>
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
   h5{
      font-weight: bold;
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
                  <h1>Oppurtunity</h1>
                  <small>Oppurtunity Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Oppurtunity</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal"><i class="fa fa-plus"></i> Add Oppurtunity</a>  
                              </div>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>No.</th>
                                       <th>Name</th>
                                       <th>Account</th>
                                       <th>Amount</th>
                                       <th>Source</th>
                                       <th>Stage</th>
                                       <th>Create Quote</th>
                                       <th>Created At</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $an=1;
                                       while($all_accounts = $accounts_exe->fetch_assoc()) {
                                          $ac_ids = $all_accounts['account_id'];
                                          $get_acc_name = "SELECT * FROM `accounts` WHERE id=$ac_ids";
                                          $exe_get_acc = $conn->query($get_acc_name);
                                          $acc_detail = $exe_get_acc->fetch_assoc();
                                          echo '<tr>
                                             <td>
                                                '.$an.'
                                             </td>
                                             <td><a href="javascript:void(0);" onclick="getaccouns('.$all_accounts['id'].')" data-toggle="modal" data-target="#viewsal">'.$all_accounts['name'].'</a></td>
                                             <td>'.$acc_detail['name'].'</td>
                                             <td><i class="fa fa-dollar"></i> '.$all_accounts['amount'].'</td>
                                             <td>'.$all_accounts['source'].'</td>
                                             <td>'.$all_accounts['stage'].'</td>
                                             <td><a href="quote.php?id='.$all_accounts['id'].'">Create Quote</a></td>
                                             <td>'.date("h:i:s A jS M, Y",strtotime($all_accounts['created_at'])).'</td>
                                             <td>
                                                <button type="button" onclick="getaccouns('.$all_accounts['id'].')" class="btn btn-add btn-xs" data-toggle="modal" data-target="#viewsal"><i class="fa fa-eye"></i></button>
                                                <button type="button" class="btn btn-danger btn-xs" onclick="accDelete('.$all_accounts['id'].')">
                                                <i class="fa fa-trash-o"></i> 
                                                </button>
                                             </td>
                                          </tr>';
                                          $an++;
                                       }
                                    ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal left fade" id="addsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Oppurtunity Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="newcontact">
                                    <fieldset>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Name</label>
                                          <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account</label>
                                          <select name="acc_id" id="acc_id" class="form-control">
                                             <option value="">--None--</option>
                                             <?php 
                                                while($company_list = $select_acc_exe->fetch_assoc()) {
                                                      echo '<option value="'.$company_list['id'].'">'.$company_list['name'].'</option>';
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Stage</label>
                                          <select name="stage" id="stage" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="Prospecting">Prospecting</option>
                                             <option value="Qualification">Qualification</option>
                                             <option value="Proposal">Proposal</option>
                                             <option value="Negotiation">Negotiation</option>
                                             <option value="Closed Won">Closed Won</option>
                                             <option value="Closed Lost">Closed Lost</option>
                                          </select>
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Amount</label>
                                          <input type="number" name="amount" id="amount" placeholder="Enter Oppurtunity Amount" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Propability %</label>
                                          <input type="number" name="propability" id="propability" placeholder="Propability %" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Closing Date</label>
                                          <input type="date" name="closing" id="closing" placeholder="Closing Date" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Contact</label>
                                          <select name="contact" id="contact" class="form-control">
                                             
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Lead Source</label>
                                          <select name="lead" id="lead" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="Call">Call</option>
                                             <option value="Email">Email</option>
                                             <option value="Existing Customer">Existing Customer</option>
                                             <option value="Partner">Partner</option>
                                             <option value="Public Relations">Public Relations</option>
                                             <option value="Web Site">Web Site</option>
                                             <option value="Campaign">Campaign</option>
                                             <option value="Other">Other</option>
                                          </select>
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="desc" id="desc" placeholder="Description" class="form-control" required="">
                                       </div>
                                       
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-left">
                                             <button type="submit" class="btn btn-add">Add</button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal right fade" id="viewsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Oppurtunity Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="col-sm-6">
                                    <h5>Name</h5>
                                    <h6 id="co_name"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Account</h5>
                                    <h6 id="co_acc"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Stage</h5>
                                    <h6 id="co_stage"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Amount</h5>
                                    <h6 id="co_amount"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Propability</h5>
                                    <h6 id="co_prop"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Closing date</h5>
                                    <h6 id="co_close"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Contact</h5>
                                    <h6 id="co_contact"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Lead Source</h5>
                                    <h6 id="co_lead"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Description</h5>
                                    <h6 id="co_desc"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Created At</h5>
                                    <h6 id="co_creat"></h6>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
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
         $('#acc_id').on('change',function(){
            var acc_id = $('#acc_id').val();
            $.ajax({
              url: 'backend/getoppcontacts.php',
              type: 'POST',
              data:{
                  id:acc_id
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  var cnst = '';
                  var cn;
                  for(cn=0;cn<result.length;cn++) {
                     cnst +='<option value="'+result[cn].id+'">'+result[cn].name+'</option>';
                  }
                  console.log(cnst);
                  $('#contact').html(cnst);
              },
              error: function(xhr, textStatus, errorThrown) {
                  alert('Network Error, Try Later!!');
                  return false;
              }
            });
         });
         $('#newcontact').submit(function(e){
            e.preventDefault();

               var acn = $('#acc_id').val();
               var stage = $('#stage').val();
               var lead = $('#lead').val();

               if(acn=='') {
                  alert('No Account Choosen');
                  return false;
               }
               else {
                  if(stage=='') {
                     alert('No Stage Choosen');
                     return false;
                  }
                  else {
                     if(lead=='') {
                        alert('No Lead Source Choosen');
                        return false;
                     }
                     else {

                            var all_res = document.getElementById('newcontact');
                            var form_data = new FormData(all_res);
                            $.ajax({
                                url:"backend/addopprtunity.php",
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
                                          swal({
                                            title: "Success",
                                            text: "Oppurtunity Created successfully!!!",
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
                                            text: "Failed to create Oppurtunity!!!",
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                          })
                                          .then((willDelete) => {
                                            window.location.reload();
                                          });
                                    }
                                },
                                error: function(){
                                    console.log("Network Error !!!");
                                }
                            });
                     }
                  }
               }

         });
         
         function getaccouns(id) {
            $.ajax({
              url: 'backend/getoppr.php',
              type: 'POST',
              data:{
                  id:id
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  console.log(result);
                  $('#co_name').html(result.name);
                  $('#co_acc').html('<a href="account_detail.php?id='+result.account_id+'" target="_blank">'+result.account+'</a>');
                  $('#co_stage').html(result.stage);
                  $('#co_amount').html('<i class="fa fa-dollar"></i> '+result.amount);
                  $('#co_prop').html(result.propabality+'%');
                  $('#co_close').html(result.close_date);
                  $('#co_contact').html('<a href="javascript:void(0);">'+result.contact+'</a>');
                  $('#co_lead').html(result.source);
                  $('#co_desc').html(result.desc);
                  $('#co_creat').html(result.created_at);

              },
              error: function(xhr, textStatus, errorThrown) {
                  alert('Network Error, Try Later!!');
                  return false;
              }
            });
         }
         function accDelete(id) {
            swal({
              title: "Are you sure?",
              text: "Do you want to delete this Oppurtunity !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deleteoppr.php',
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
                             text: "Oppurtunity Deleted successfully!!!",
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
                             text: "Failed to delete Oppurtunity details!!",
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
         }
      </script>
   </body>
</html>