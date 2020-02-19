<?php
include('backend/conn.php');
$lead_id = $_GET['id'];

$account_query = $conn->query("SELECT * FROM `leads` WHERE `id`=$lead_id");
$account_records = $account_query->fetch_assoc();

$contact_query = $conn->query("SELECT * FROM `leads` WHERE `id`=$lead_id");
$contact_records = $contact_query->fetch_assoc();

$oppur_query = $conn->query("SELECT * FROM `leads` WHERE `id`=$lead_id");
$oppur_records = $oppur_query->fetch_assoc();

$contact_account = $conn->query("SELECT * FROM `accounts` ORDER BY `name` ASC");
$oppur_account = $conn->query("SELECT * FROM `accounts` ORDER BY `name` ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Conversion</title>
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
                  <i class="fa fa-history"></i>
               </div>
               <div class="header-title">
                  <h1>Conversion of Lead Record</h1>
                  <small>Convertion Type</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Convert to Account</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="panel-group" role="tablist" aria-multiselectable="true">
                              <div class="panel panel-default">
                                 <div class="panel-heading" role="tab">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Account
                                    </a>
                                 </div>
                                 <div id="collapseAccount" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <form class="form-horizontal" id="addaccount">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Account Name</label>
                                          <input type="text" name="acc_name" id="acc_name" placeholder="Account Name" class="form-control" value="<?php echo $account_records['acc'];?>" required="">
                                          <input type="hidden" name="id" id="id" placeholder="Account Name" class="form-control" required="">
                                          <input type="hidden" id="convert_id" name="convert_id" value="<?php echo $lead_id;?>">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Email</label>
                                          <input type="email" name="email" id="email" placeholder="Account Email" value="<?php echo $account_records['email'];?>" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Owner</label>
                                          <input type="text" name="acc_own" value="<?php echo $account_records['fname'].' '.$account_records['lname'];?>" id="acc_own" placeholder="Account Owner" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <select name="type" id="type" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="Analyst">Analyst</option>
                                             <option value="Competitor">Competitor</option>
                                             <option value="Customer">Customer</option>
                                             <option value="Integrator">Integrator</option>
                                             <option value="Investor">Investor</option>
                                             <option value="Partner">Partner</option>
                                             <option value="Press">Press</option>
                                             <option value="Prospect">Prospect</option>
                                             <option value="Reseller">Reseller</option>
                                             <option value="Others">Others</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Website</label>
                                          <input type="text" id="website" name="website" placeholder="Website" value="<?php echo $account_records['website'];?>" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone Number</label>
                                          <input type="number" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $account_records['phone'];?>" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="desc" id="desc" placeholder="Description" value="<?php echo $account_records['desc'];?>" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Industry</label>
                                          <select name="industry" id="industry" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="Agricultural">Agricultural</option>
                                             <option value="Apparel">Apparel</option>
                                             <option value="Banking">Banking</option>
                                             <option value="Biotechnology">Biotechnology</option>
                                             <option value="Chemicals">Chemicals</option>
                                             <option value="Communications">Communications</option>
                                             <option value="Constructions">Constructions</option>
                                             <option value="Consulting">Consulting</option>
                                             <option value="Defense">Defense</option>
                                             <option value="Education">Education</option>
                                             <option value="Electronic">Electronic</option>
                                             <option value="Engineering">Engineering</option>
                                             <option value="Energy">Energy</option>
                                             <option value="Government">Government</option>
                                             <option value="Insurance">Insurance</option>
                                             <option value="Manufacturing">Manufacturing</option>
                                             <option value="Media">Media</option>
                                             <option value="Shipping">Shipping</option>
                                             <option value="Others">Others</option>
                                             <option value="Technology">Technology</option>
                                             <option value="Utility">Utility</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Employees</label>
                                          <input type="number" name="emps" id="emps" placeholder="No of Employees" class="form-control" required="">
                                       </div>
                                       <h3>Address Information</h1><hr>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Address</label>
                                          <input type="text" name="baddress" id="baddress" placeholder="Billing Address" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Street</label>
                                          <input type="text" name="bstreet" value="<?php echo $account_records['street'];?>" id="bstreet" placeholder="Billing Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing City</label>
                                          <input type="text" name="bcity" id="bcity" value="<?php echo $account_records['city'];?>" placeholder="Billing City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing State</label>
                                          <input type="text" name="bstate" id="bstate" value="<?php echo $account_records['state'];?>" placeholder="Billing State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Zip</label>
                                          <input type="text" name="bzip" id="bzip" value="<?php echo $account_records['zip'];?>" placeholder="Billing Zip" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Country</label>
                                          <input type="text" name="bcountry" id="bcountry" value="<?php echo $account_records['country'];?>" placeholder="Billing Country" class="form-control" required="">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <input type="checkbox" name="homepostalcheck" id="homepostalcheck"/>Same as above:
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Address</label>
                                          <input type="text" name="saddress" id="saddress"  placeholder="Shipping Address" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Street</label>
                                          <input type="text" name="sstreet" id="sstreet"  placeholder="Shipping Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping City</label>
                                          <input type="text" name="scity" id="scity" placeholder="Shipping City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping State</label>
                                          <input type="text" name="sstate" id="sstate" placeholder="Shipping State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Zip</label>
                                          <input type="number" name="szip" id="szip" placeholder="Shipping Zip" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Country</label>
                                          <input type="text" name="scountry" id="scountry" placeholder="Shipping Country" class="form-control" required="">
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
                        </div>  
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Convert to Contact</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="panel-group" role="tablist" aria-multiselectable="true">
                              <div class="panel panel-default">
                                 <div class="panel-heading" role="tab">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseContact" aria-expanded="true" aria-controls="collapseContact">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Contact
                                    </a>
                                 </div>
                                 <div id="collapseContact" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <form class="form-horizontal" id="newcontact">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Name</label>
                                          <input type="text" name="name" value="<?php echo $contact_records['fname'].' '.$contact_records['lname'];?>" id="name" placeholder="Enter Name" class="form-control" required="">
                                          <input type="hidden" id="convert_id" name="convert_id" value="<?php echo $lead_id;?>">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Account</label>
                                          <select name="acc_id" id="acc_id" class="form-control">
                                             <?php 
                                                while($company_list = $contact_account->fetch_assoc()) {
                                                      echo '<option value="'.$company_list['id'].'">'.$company_list['name'].'</option>';
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Email</label>
                                          <input type="email" value="<?php echo $contact_records['email'];?>" name="email" id="email" placeholder="Enter Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone Number</label>
                                          <input type="number" name="phone" value="<?php echo $contact_records['phone'];?>"  id="phone" placeholder="Phone Number" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">City</label>
                                          <input type="text" name="city" value="<?php echo $contact_records['city'];?>"  id="city" placeholder="City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Country</label>
                                          <input type="text" name="country" value="<?php echo $contact_records['country'];?>"  id="country" placeholder="Country" class="form-control" required="">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="desc" id="desc" value="<?php echo $contact_records['desc'];?>"  placeholder="Description" class="form-control" required="">
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
                        </div>  
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Convert to Oppurtunity</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="panel-group" role="tablist" aria-multiselectable="true">
                              <div class="panel panel-default">
                                 <div class="panel-heading" role="tab" id="headingOne">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOppr" aria-expanded="true" aria-controls="collapseOppr">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Oppurtunity 
                                    </a>
                                 </div>
                                 <div id="collapseOppr" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <form class="form-horizontal" id="newopp">
                                    <fieldset>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Name</label>
                                          <input type="text" name="name" id="name" value="<?php echo $oppur_records['fname'].' '.$oppur_records['lname'];?>" placeholder="Enter Name" class="form-control" required="">
                                          <input type="hidden" id="convert_id" name="convert_id" value="<?php echo $lead_id;?>">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account</label>
                                          <select name="acc_id" id="acc_id" class="form-control">
                                             <option value="">--None--</option>
                                             <?php 
                                                while($companies = $oppur_account->fetch_assoc()) {
                                                      echo '<option value="'.$companies['id'].'">'.$companies['name'].'</option>';
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
                                          <input type="number" name="amount" value="<?php echo $oppur_records['opp'];?>" id="amount" placeholder="Enter Oppurtunity Amount" class="form-control" required="">
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
                                             <option value="Website">Website</option>
                                             <option value="Campaign">Campaign</option>
                                             <option value="Other">Other</option>
                                          </select>
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="desc" id="desc" value="<?php echo $oppur_records['desc'];?>" placeholder="Description" class="form-control" required="">
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
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
         $(document).ready(function(){
            $('#eindustry').val('<?php echo $account_records['industry'];?>');
            $('#newcontact #acc_id').val('<?php echo $contact_records['acc'];?>');
            $('#newopp #lead').val('<?php echo $oppur_records['source'];?>');
         });
         function setBillingAddress(){
           if ($("#homepostalcheck").is(":checked")) {
                  $('#saddress').val($('#baddress').val());
                  $('#sstreet').val($('#bstreet').val());
                  $('#scity').val($('#bcity').val());
                  $('#sstate').val($('#bstate').val());
                  $('#szip').val($('#bzip').val());
                  $('#scountry').val($('#bcountry').val());
           } 
           else {
               $('#saddress').val('');
                  $('#sstreet').val('');
                  $('#scity').val('');
                  $('#sstate').val('');
                  $('#szip').val('');
                  $('#scountry').val('');
           }
         }

         $('#homepostalcheck').click(function(){
           setBillingAddress();
         })
         $('#addaccount').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('addaccount');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/addaccount.php",
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
                              updateConvert(<?php echo $lead_id;?>,'Converted to Account');
                              swal({
                                title: "Success",
                                text: "Account Created successfully!!!",
                                icon: "success",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                window.location.href='account.php';
                              });
                        }
                        else {
                            swal({
                                title: "Failed",
                                text: "Failed to create account!!!",
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
         });
         $('#newcontact').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('newcontact');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/addcontact.php",
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
                           updateConvert(<?php echo $lead_id;?>,'Converted to Contact');
                              swal({
                                title: "Success",
                                text: "Contact Created successfully!!!",
                                icon: "success",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                window.location.href='contacts.php';
                              });
                        }
                        else {
                            swal({
                                title: "Failed",
                                text: "Failed to create contact!!!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                              })
                              .then((willDelete) => {
                                 updateConvert(<?php echo $lead_id;?>);
                                window.location.reload();
                              });
                        }
                    },
                    error: function(){
                        console.log("Network Error !!!");
                    }
                });
         });
          $('#newopp').submit(function(e){
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

                            var all_res = document.getElementById('newopp');
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
                                       updateConvert(<?php echo $lead_id;?>,'Converted to Oppurtunity');
                                          swal({
                                            title: "Success",
                                            text: "Oppurtunity Created successfully!!!",
                                            icon: "success",
                                            buttons: true,
                                            dangerMode: true,
                                          })
                                          .then((willDelete) => {
                                            window.location.href='oppurtunity.php';
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
          function updateConvert(id,stat) {
            $.ajax({
              url: 'backend/updatestatus.php',
              type: 'POST',
              data:{
                  id:id,
                  stat:stat
              },
              async:false,
              success: function(data){
                  console.log(data);
              },
              error: function(xhr, textStatus, errorThrown) {
                  alert('Network Error, Try Later!!');
                  return false;
              }
            });
          }
         $('#newopp #acc_id').on('change',function(){
            var acc_id = $('#newopp #acc_id').val();
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
      </script>
   </body>
</html>