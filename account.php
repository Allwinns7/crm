<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $accounts = "SELECT * FROM `accounts` ORDER BY id ASC";
   $accounts_exe = $conn->query($accounts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Accounts</title>
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
                  <h1>Account</h1>
                  <small>Account Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add Account</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal"><i class="fa fa-plus"></i> Add Account</a>  
                              </div>
                              <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                              <ul class="dropdown-menu exp-drop" role="menu">
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false'});"> 
                                    <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});">
                                    <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON (ignoreColumn)</a>
                                 </li>
                                 <li><a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'true'});">
                                    <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON (with Escape)</a>
                                 </li>
                                 <li class="divider"></li>
                                 <li><a href="#" onclick="$('#dataTableExample1').tableExport({type:'xml',escape:'false'});">
                                    <img src="assets/dist/img/xml.png" width="24" alt="logo"> XML</a>
                                 </li>
                                 <li><a href="#" onclick="$('#dataTableExample1').tableExport({type:'sql'});"> 
                                    <img src="assets/dist/img/sql.png" width="24" alt="logo"> SQL</a>
                                 </li>
                                 <li class="divider"></li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'csv',escape:'false'});"> 
                                    <img src="assets/dist/img/csv.png" width="24" alt="logo"> CSV</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'txt',escape:'false'});"> 
                                    <img src="assets/dist/img/txt.png" width="24" alt="logo"> TXT</a>
                                 </li>
                                 <li class="divider"></li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'excel',escape:'false'});"> 
                                    <img src="assets/dist/img/xls.png" width="24" alt="logo"> XLS</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'doc',escape:'false'});">
                                    <img src="assets/dist/img/word.png" width="24" alt="logo"> Word</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'powerpoint',escape:'false'});"> 
                                    <img src="assets/dist/img/ppt.png" width="24" alt="logo"> PowerPoint</a>
                                 </li>
                                 <li class="divider"></li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'png',escape:'false'});"> 
                                    <img src="assets/dist/img/png.png" width="24" alt="logo"> PNG</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> 
                                    <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                                 </li>
                              </ul>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>No.</th>
                                       <th>Acc Name</th>
                                       <th>Website</th>
                                       <th>Phone No</th>
                                       <th>Owner name</th>
                                       <th>Type</th>
                                       <th>Industry</th>
                                       <th>Country</th>
                                       <th>Joined On</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $an=1;
                                       while($all_accounts = $accounts_exe->fetch_assoc()) {
                                          echo '<tr>
                                             <td>
                                                '.$an.'
                                             </td>
                                             <td><a href="account_detail.php?id='.$all_accounts['id'].'">'.$all_accounts['name'].'</a></td>
                                             <td>'.$all_accounts['website'].'</td>
                                             <td>'.$all_accounts['phone'].'</td>
                                             <td>'.$all_accounts['owner'].'</td>
                                             <td>'.$all_accounts['type'].'</td>
                                             <td>'.$all_accounts['industry'].'</td>
                                             <td>'.$all_accounts['bcountry'].'</td>
                                             <td>'.date("h:i:s A jS M, Y",strtotime($all_accounts['created_at'])).'</td>
                                             <td>
                                                <button type="button" onclick="getaccouns('.$all_accounts['id'].')" class="btn btn-add btn-xs" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
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
               <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-plus m-r-5"></i> Edit Account</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="editaccount">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Account Name</label>
                                          <input type="text" name="eacc_name" id="eacc_name" placeholder="Account Name" class="form-control" required="">
                                          <input type="hidden" name="eid" id="eid" placeholder="Account Name" class="form-control" required="">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Email</label>
                                          <input type="email" name="eemail" id="eemail" placeholder="Account Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Owner</label>
                                          <input type="text" name="eacc_own" id="eacc_own" placeholder="Account Owner" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <select name="etype" id="etype" class="form-control">
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
                                          <input type="text" id="ewebsite" name="ewebsite" placeholder="Website" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone Number</label>
                                          <input type="number" name="ephone" id="ephone" placeholder="Phone Number" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="edesc" id="edesc" placeholder="Description" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Industry</label>
                                          <select name="eindustry" id="eindustry" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="Agricultural">Agricultural</option>
                                             <option value="Apparel">Apparel</option>
                                             <option value="Banking">Banking</option>
                                             <option value="Biotechnology">Biotechnology</option>
                                             <option value="Chemicals">Chemicals</option>
                                             <option value="Communications">Communications</option>
                                             <option value="Constructions">Constructions</option>
                                             <option value="Consulting">Consulting</option>
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
                                          <input type="number" name="eemps" id="eemps" placeholder="No of Employees" class="form-control" required="">
                                       </div>
                                       <h3>Address Information</h1><hr>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Address</label>
                                          <input type="text" name="ebaddress" id="ebaddress" placeholder="Billing Address" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Street</label>
                                          <input type="text" name="ebstreet" id="ebstreet" placeholder="Billing Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing City</label>
                                          <input type="text" name="ebcity" id="ebcity" placeholder="Billing City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing State</label>
                                          <input type="text" name="ebstate" id="ebstate" placeholder="Billing State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Zip</label>
                                          <input type="text" name="ebzip" id="ebzip" placeholder="Billing Zip" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Country</label>
                                          <input type="text" name="ebcountry" id="ebcountry" placeholder="Billing Country" class="form-control" required="">
                                       </div>
                                      
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Address</label>
                                          <input type="text" name="esaddress" id="esaddress"  placeholder="Shipping Address" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Street</label>
                                          <input type="text" name="esstreet" id="esstreet"  placeholder="Shipping Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping City</label>
                                          <input type="text" name="escity" id="escity" placeholder="Shipping City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping State</label>
                                          <input type="text" name="esstate" id="esstate" placeholder="Shipping State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Zip</label>
                                          <input type="number" name="eszip" id="eszip" placeholder="Shipping Zip" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Shipping Country</label>
                                          <input type="text" name="escountry" id="escountry" placeholder="Shipping Country" class="form-control" required="">
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-left">
                                             <button type="submit" class="btn btn-add">Update</button>
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
               <div class="modal fade" id="addsal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Account Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="newaccount">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Account Name</label>
                                          <input type="text" name="acc_name" id="acc_name" placeholder="Account Name" class="form-control" required="">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Email</label>
                                          <input type="email" name="email" id="email" placeholder="Account Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Owner</label>
                                          <input type="text" name="acc_own" id="acc_own" placeholder="Account Owner" class="form-control" required="">
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
                                          <input type="text" id="website" name="website" placeholder="Website" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone Number</label>
                                          <input type="number" name="phone" id="phone" placeholder="Phone Number" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="desc" id="desc" placeholder="Description" class="form-control" required="">
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
                                          <input type="text" name="bstreet" id="bstreet" placeholder="Billing Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing City</label>
                                          <input type="text" name="bcity" id="bcity" placeholder="Billing City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing State</label>
                                          <input type="text" name="bstate" id="bstate" placeholder="Billing State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Zip</label>
                                          <input type="number" name="bzip" id="bzip" placeholder="Billing Zip" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Billing Country</label>
                                          <input type="text" name="bcountry" id="bcountry" placeholder="Billing Country" class="form-control" required="">
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
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-user m-r-5"></i> Delete Account </h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal">
                                    <fieldset>
                                       <div class="col-md-12 form-group user-form-group">
                                          <label class="control-label">Are you sure you want to delete this account ?</label>
                                          <div class="pull-right">
                                             <button type="submit" class="btn btn-add btn-sm">YES</button>
                                             <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">NO</button>
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
         $('#newaccount').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('newaccount');
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
                              swal({
                                title: "Success",
                                text: "Account Created successfully!!!",
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
         $('#editaccount').submit(function(e){
            e.preventDefault();
            var all_res = document.getElementById('editaccount');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/updateaccount.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData:false, 
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        
                        if(result.status=='success') {
                           swal({
                             title: "Success",
                             text: "Account Updated successfully!!!",
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
                             text: "Failed to update account details!!",
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
         function getaccouns(id) {
            $.ajax({
              url: 'backend/getaccounts.php',
              type: 'POST',
              data:{
                  id:id
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  $('#eid').val(result.id);
                  $('#eacc_name').val(result.name);
                  $('#eemail').val(result.email);
                  $('#eacc_own').val(result.owner);
                  $('#etype').val(result.type);
                  $('#ewebsite').val(result.website);
                  $('#ephone').val(result.phone);
                  $('#edesc').val(result.description);
                  $('#eindustry').val(result.industry);
                  $('#eemps').val(result.employees);
                  $('#ebaddress').val(result.baddress);
                  $('#ebstreet').val(result.bstreet);
                  $('#ebcity').val(result.bcity);
                  $('#ebstate').val(result.bstate);
                  $('#ebzip').val(result.bzip);
                  $('#ebcountry').val(result.bcountry);
                  $('#esaddress').val(result.saddress);
                  $('#esstreet').val(result.sstreet);
                  $('#escity').val(result.scity);
                  $('#esstate').val(result.sstate);
                  $('#eszip').val(result.szip);
                  $('#escountry').val(result.scountry);
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
              text: "Do you want to delete this account !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deleteaccount.php',
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
                             text: "Account Deleted successfully!!!",
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
                             text: "Failed to delete account details!!",
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