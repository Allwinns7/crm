<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $leads = "SELECT * FROM `leads` ORDER BY id ASC";
   $leads_exe = $conn->query($leads);

   $contacts = "SELECT * FROM `users` ORDER BY username ASC";
   $contacts_exe = $conn->query($contacts);
   $contacts_exeas = $conn->query($contacts);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Leads</title>
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
                  <h1>Leads</h1>
                  <small>Leads Details</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add Leads</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#addsal"><i class="fa fa-plus"></i> Add Leads</a>  
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
                                       <th>Name</th>
                                       <th>Status</th>
                                       <th>Email</th>
                                       <th>Phone No</th>
                                       <th>Source</th>
                                       <th>Assigned User</th>
                                       <th>Created Time</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $an=1;
                                       while($all_leads = $leads_exe->fetch_assoc()) {
                                          $usr_ids = $all_leads['assigned'];

                                          $get_acc_name = "SELECT * FROM `users` WHERE id=$usr_ids";
                                          
                                          $exe_get_acc = $conn->query($get_acc_name);
                                          $acc_detail = $exe_get_acc->fetch_assoc();
                                          echo '<tr>
                                             <td>
                                                '.$an.'
                                             </td>
                                             <td><b><a href="leads_detail.php?id='.$all_leads['id'].'">'.$all_leads['fname'].'</a></b></td>
                                             <td><a href="javascript:void(0);">'.$all_leads['status'].'</a></td>
                                             <td>'.$all_leads['email'].'</td>
                                             <td>'.$all_leads['phone'].'</td>
                                             <td>'.$all_leads['source'].'</td>
                                             <td>'.$acc_detail['username'].'</td>
                                             <td>'.date("h:i:s A jS M, Y",strtotime($all_leads['created_at'])).'</td>
                                             <td>
                                                <button type="button" onclick="getaccouns('.$all_leads['id'].')" class="btn btn-add btn-xs" data-toggle="modal" data-target="#update"><i class="fa fa-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-xs" onclick="accDelete('.$all_leads['id'].')">
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
                           <h3><i class="fa fa-plus m-r-5"></i> Edit Lead</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="editaccount">
                                    <fieldset>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" name="efname" id="efname" placeholder="First Name" class="form-control" required="">
                                          <input type="hidden" name="eid" id="eid" required="">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" name="elname" id="elname" placeholder="Last Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Name</label>
                                          <input type="text" name="eacname" id="eacname" placeholder="Account Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Assigned To</label>
                                          <select name="eassigned_to" id="eassigned_to" class="form-control">
                                          <?php 
                                                while($assgd = $contacts_exe->fetch_assoc()){
                                                   echo "<option value='".$assgd['id']."'>".$assgd['username']."</option>";
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Email</label>
                                          <input type="email" id="eemail" name="eemail" placeholder="Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone</label>
                                          <input type="number" id="ephone" name="ephone" placeholder="Phone" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Title</label>
                                          <input type="text" id="etitle" name="etitle" placeholder="Title" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Website</label>
                                          <input type="text" name="ewebsite" id="ewebsite" placeholder="Website" class="form-control" required="">
                                       </div>
                                       <h3>Address Information</h1><hr>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Street</label>
                                          <input type="text" name="estreet" id="estreet" placeholder="Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">City</label>
                                          <input type="text" name="ecity" id="ecity" placeholder="City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">State</label>
                                          <input type="text" name="estate" id="estate" placeholder="State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Zip</label>
                                          <input type="number" name="ezip" id="ezip" placeholder="Zip Code" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Country</label>
                                          <input type="text" name="ecountry" id="ecountry" placeholder="Country" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Status</label>
                                          <select name="elstatus" id="elstatus" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="New">New</option>
                                             <option value="Assigned">Assigned</option>
                                             <option value="In Process">In Process</option>
                                             <option value="Converted">Converted</option>
                                             <option value="Dead">Dead</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Source</label>
                                          <select name="esource" id="esource" class="form-control">
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
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Oppurtunity Amount</label>
                                          <input type="number" name="eoppr" id="eoppr"  placeholder="Oppurtnity Amount" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Industry</label>
                                          <select name="eindustry" id="eindustry" class="form-control">
                                             <option value="" selected="">--None--</option>
                                             <option value="Advertising">Advertising</option>
                                             <option value="Aerospace">Aerospace</option>
                                             <option value="Agriculture">Agriculture</option>
                                             <option value="Apparel Accessories">Apparel Accessories</option>
                                             <option value="Architecture">Architecture</option>
                                             <option value="Automotive">Automotive</option>
                                             <option value="Banking">Banking</option>
                                             <option value="Biotechnology">Biotechnology</option>
                                             <option value="Building Materials Equipment">Building Materials Equipment</option>
                                             <option value="Chemical">Chemical</option>
                                             <option value="Computer">Computer</option>
                                             <option value="Construction">Construction</option>
                                             <option value="Consulting">Consulting</option>
                                             <option value="Creative">Creative</option>
                                             <option value="Culture">Culture</option>
                                             <option value="Defense">Defense</option>
                                             <option value="Education">Education</option>
                                             <option value="Electric Power">Electric Power</option>
                                             <option value="Electronics">Electronics</option>
                                             <option value="Energy">Energy</option>
                                             <option value="Entertainment Leisure">Entertainment Leisure</option>
                                             <option value="Finance">Finance</option>
                                             <option value="Food Beverage">Food Beverage</option>
                                             <option value="Grocery">Grocery</option>
                                             <option value="Healthcare">Healthcare</option>
                                             <option value="Hospitality">Hospitality</option>
                                             <option value="Insurance">Insurance</option>
                                             <option value="Legal">Legal</option>
                                             <option value="Manufacturing">Manufacturing</option>
                                             <option value="Marketing">Marketing</option>
                                             <option value="Mass Media">Mass Media</option>
                                             <option value="Mining">Mining</option>
                                             <option value="Music">Music</option>
                                             <option value="Petroleum">Petroleum</option>
                                             <option value="Publishing">Publishing</option>
                                             <option value="Real Estate">Real Estate</option>
                                             <option value="Retail">Retail</option>
                                             <option value="Service">Service</option>
                                             <option value="Shipping">Shipping</option>
                                             <option value="Software">Software</option>
                                             <option value="Sports">Sports</option>
                                             <option value="Support">Support</option>
                                             <option value="Technology">Technology</option>
                                             <option value="Telecommunications">Telecommunications</option>
                                             <option value="Television">Television</option>
                                             <option value="Testing, Inspection Certification">Testing, Inspection Certification</option>
                                             <option value="Transportation">Transportation</option>
                                             <option value="Travel">Travel</option>
                                             <option value="Venture Capital">Venture Capital</option>
                                             <option value="Water">Water</option>
                                             <option value="Wholesale">Wholesale</option>
                                          </select>
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label>
                                          <input type="text" name="edesc" id="edesc" placeholder="Description" class="form-control" required="">
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
                           <h3>Lead Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="newaccount">
                                    <fieldset>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control" required="">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Account Name</label>
                                          <input type="text" name="acname" id="acname" placeholder="Account Name" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Assigned To</label>
                                          <select name="assigned_to" id="assigned_to" class="form-control">
                                             <?php 
                                                while($assgdad = $contacts_exeas->fetch_assoc()){
                                                   echo "<option value='".$assgdad['id']."'>".$assgdad['username']."</option>";
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Email</label>
                                          <input type="email" id="email" name="email" placeholder="Email" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Phone</label>
                                          <input type="number" id="phone" name="phone" placeholder="Phone" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Title</label>
                                          <input type="text" id="title" name="title" placeholder="Title" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Website</label>
                                          <input type="text" name="website" id="website" placeholder="Website" class="form-control" required="">
                                       </div>
                                       <h3>Address Information</h1><hr>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Street</label>
                                          <input type="text" name="street" id="street" placeholder="Street" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">City</label>
                                          <input type="text" name="city" id="city" placeholder="City" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">State</label>
                                          <input type="text" name="state" id="state" placeholder="State" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Zip</label>
                                          <input type="number" name="zip" id="zip" placeholder="Zip Code" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Country</label>
                                          <input type="text" name="country" id="country" placeholder="Country" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Status</label>
                                          <select name="lstatus" id="lstatus" class="form-control">
                                             <option value="">--None--</option>
                                             <option value="New">New</option>
                                             <option value="Assigned">Assigned</option>
                                             <option value="In Process">In Process</option>
                                             <option value="Converted">Converted</option>
                                             <option value="Dead">Dead</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Source</label>
                                          <select name="source" id="source" class="form-control">
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
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Oppurtunity Amount</label>
                                          <input type="number" name="oppr" id="oppr"  placeholder="Oppurtnity Amount" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Industry</label>
                                          <select name="industry" id="industry" class="form-control">
                                             <option value="" selected="">--None--</option>
                                             <option value="Advertising">Advertising</option>
                                             <option value="Aerospace">Aerospace</option>
                                             <option value="Agriculture">Agriculture</option>
                                             <option value="Apparel Accessories">Apparel Accessories</option>
                                             <option value="Architecture">Architecture</option>
                                             <option value="Automotive">Automotive</option>
                                             <option value="Banking">Banking</option>
                                             <option value="Biotechnology">Biotechnology</option>
                                             <option value="Building Materials Equipment">Building Materials Equipment</option>
                                             <option value="Chemical">Chemical</option>
                                             <option value="Computer">Computer</option>
                                             <option value="Construction">Construction</option>
                                             <option value="Consulting">Consulting</option>
                                             <option value="Creative">Creative</option>
                                             <option value="Culture">Culture</option>
                                             <option value="Defense">Defense</option>
                                             <option value="Education">Education</option>
                                             <option value="Electric Power">Electric Power</option>
                                             <option value="Electronics">Electronics</option>
                                             <option value="Energy">Energy</option>
                                             <option value="Entertainment Leisure">Entertainment Leisure</option>
                                             <option value="Finance">Finance</option>
                                             <option value="Food Beverage">Food Beverage</option>
                                             <option value="Grocery">Grocery</option>
                                             <option value="Healthcare">Healthcare</option>
                                             <option value="Hospitality">Hospitality</option>
                                             <option value="Insurance">Insurance</option>
                                             <option value="Legal">Legal</option>
                                             <option value="Manufacturing">Manufacturing</option>
                                             <option value="Marketing">Marketing</option>
                                             <option value="Mass Media">Mass Media</option>
                                             <option value="Mining">Mining</option>
                                             <option value="Music">Music</option>
                                             <option value="Petroleum">Petroleum</option>
                                             <option value="Publishing">Publishing</option>
                                             <option value="Real Estate">Real Estate</option>
                                             <option value="Retail">Retail</option>
                                             <option value="Service">Service</option>
                                             <option value="Shipping">Shipping</option>
                                             <option value="Software">Software</option>
                                             <option value="Sports">Sports</option>
                                             <option value="Support">Support</option>
                                             <option value="Technology">Technology</option>
                                             <option value="Telecommunications">Telecommunications</option>
                                             <option value="Television">Television</option>
                                             <option value="Testing, Inspection Certification">Testing, Inspection Certification</option>
                                             <option value="Transportation">Transportation</option>
                                             <option value="Travel">Travel</option>
                                             <option value="Venture Capital">Venture Capital</option>
                                             <option value="Water">Water</option>
                                             <option value="Wholesale">Wholesale</option>
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
         $('#newaccount').submit(function(e){
            e.preventDefault();
                var all_res = document.getElementById('newaccount');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/addlead.php",
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
                                text: "Lead Created successfully!!!",
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
                                text: "Failed to create Lead!!!",
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
                    url:"backend/updatelead.php",
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
                             text: "Lead Updated successfully!!!",
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
                             text: "Failed to update lead details!!",
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
              url: 'backend/getleads.php',
              type: 'POST',
              data:{
                  id:id
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  $('#eid').val(result.id);
                  $('#efname').val(result.fname);
                  $('#elname').val(result.lname);
                  $('#eacname').val(result.acc);
                  $('#eemail').val(result.email);
                  
                  $('#ephone').val(result.phone);
                  $('#ewebsite').val(result.website);
                  $('#etitle').val(result.title);

                  $('#edesc').val(result.desc);
                  $('#eindustry').val(result.industry);
                  $('#eassigned_to').val(result.assigned_to);
                 
                  
                  $('#estreet').val(result.street);
                  $('#ecity').val(result.city);
                  $('#estate').val(result.state);
                  $('#ezip').val(result.zip);
                  $('#ecountry').val(result.country);
                  
                  $('#escountry').val(result.scountry);
                  $('#elstatus').val(result.lstatus);
                  $('#esource').val(result.source);
                  $('#eoppr').val(result.oppr);
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
              text: "Do you want to delete this lead !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deletelead.php',
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
                             text: "Lead Deleted successfully!!!",
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
                             text: "Failed to delete lead details!!",
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