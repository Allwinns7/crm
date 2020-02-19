<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $user_id = $_SESSION['user_id'];

   $accounts = "SELECT * FROM `calendar` WHERE user=$user_id AND MONTH(start) = MONTH(CURRENT_DATE()) AND YEAR(start) = YEAR(CURRENT_DATE()) ";
   $accounts_exe = $conn->query($accounts);

   $sql = "SELECT * FROM `calendar` WHERE user=$user_id";
   $sql_exe = $conn->query($sql);
   $result = array();
   while($account = $sql_exe->fetch_assoc()) {
         $row_array['title'] = $account['message'];
         $row_array['start'] = $account['start'];
         $row_array['end'] = $account['end'];

         array_push($result,$row_array);  

      }
   $cquery = "SELECT * FROM `contacts` ORDER BY name ASC";
   $contact_query = $conn->query($cquery);
   $econtact_query = $conn->query($cquery);

   $leadsq = "SELECT * FROM `leads` ORDER BY fname ASC";
   $leadsq_query = $conn->query($leadsq);
   $eleadsq_query = $conn->query($leadsq);

   $teams_query = $conn->query("SELECT * FROM `teams` ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Calendar</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="https://election.news7tamilvideos.com/editor/user/css/select2.min.css" rel="stylesheet" />
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/fullcalendar/fullcalendar.print.min.css" rel="stylesheet" media='print' type="text/css"/>
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <link href="http://demos.codexworld.com/bootstrap-datetimepicker-add-date-time-picker-input-field/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
      <style>
         .select2-container{
            width: 94% !important;
         }
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
               <div class="header-icon"><i class="fa fa-calendar-o"></i></div>
               <div class="header-title">
                  <h1>Calender</h1>
                  <small>Show Events</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12 col-md-3">
                     <div class="panel panel-bd">
                        <div class="panel-body">
                           <div id='external-events'>
                              <h4>Events this Month</h4>
                              <?php
                                 $i=1;
                                 while($events =$accounts_exe->fetch_assoc()) {
                                    echo '<div onclick="show_event('.$events['id'].')" class="fc-event">'.$i.'. '.$events['message'].' : '.$events['start'].'</div>';
                                    $i++;
                                 }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-9">
                     <div class="panel panel-bd">
                        <div class="panel-body">
                           <!-- calender -->
                           <div id='calendar'></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal left fade" id="addsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Event Information</h1><hr>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="newevent">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Event Title</label>
                                          <input type="text" name="title" id="title" placeholder="Event Title" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Start Date</label>
                                          <input type="text" name="start" id="start" placeholder="Start Date" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">End Date</label>
                                          <input type="text" name="end" id="end" placeholder="Start Date" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Location</label>
                                          <input type="text" name="location" id="location" placeholder="Event Location" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Event Type</label>
                                          <select name="eventt" id="eventt" class="form-control">
                                             <option value="Important">Important</option>
                                             <option value="Opportunity">Opportunity</option>
                                             <option value="Optional">Optional</option>
                                             <option value="Critical">Critical</option>
                                             <option value="Meeting">Meeting</option>
                                             <option value="Social">Social</option>
                                             <option value="Time Off">Time Off</option>
                                             <option value="Private">Private</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label" style="width: 100%;text-align: left;">Contact</label>
                                          <select name="contacts" id="contacts" class="form-control">
                                             <?php 

                                                while($contact_list = $contact_query->fetch_assoc()) {
                                                   echo '<option value="'.$contact_list['id'].'">'.$contact_list['name'].'</option>';
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label" style="width: 100%;text-align: left;">Lead</label>
                                          <select name="leads" id="leads" class="form-control">
                                             <?php 

                                                while($leads_list = $leadsq_query->fetch_assoc()) {
                                                   echo '<option value="'.$leads_list['id'].'">'.$leads_list['fname'].'</option>';
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label" style="width: 100%;text-align: left;">Team</label>
                                          <select name="teams" id="teams" class="form-control">
                                             <option value="0">Select Team</option>
                                             <?php 

                                                while($teams_list = $teams_query->fetch_assoc()) {
                                                   echo '<option value="'.$teams_list['id'].'">'.$teams_list['name'].'</option>';
                                                }
                                             ?>
                                          </select>
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
                           <h3>Event Information</h1>
                              <h6 id="edit" style="margin-right: 5px;"></h6>
                              <h6 id="remv"></h6>
                              <button style="margin-left: 5px;" type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="col-sm-12">
                                    <h5>Event</h5>
                                    <h6 id="co_name"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Start Date</h5>
                                    <h6 id="co_acc"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>End Date</h5>
                                    <h6 id="co_stage"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Contacts</h5>
                                    <h6 id="co_cnts"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Leads</h5>
                                    <h6 id="co_leds"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Location</h5>
                                    <h6 id="co_amount"></h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <h5>Event Type</h5>
                                    <h6 id="co_prop"></h6>
                                 </div>
                                 <div class="col-sm-12">
                                    <h5>Created On</h5>
                                    <h6 id="ccon"></h6>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal right fade" id="editsal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                  <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                           <h3>Event Information</h1>
                              <button style="margin-left: 5px;" type="button" class="btn btn-success pull-left" data-dismiss="modal">Close</button>
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal" id="enewevent">
                                    <fieldset>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Event Title</label>
                                          <input type="text" name="etitle" id="etitle" placeholder="Event Title" class="form-control" required="">
                                          <input type="hidden" name="eid" id="eid" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Start Date</label>
                                          <input type="text" name="estart" id="estart" placeholder="Start Date" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">End Date</label>
                                          <input type="text" name="eend" id="eend" placeholder="Start Date" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Location</label>
                                          <input type="text" name="elocation" id="elocation" placeholder="Event Location" class="form-control" required="">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Event Type</label>
                                          <select name="eevent" id="eevent" class="form-control">
                                             <option value="Important">Important</option>
                                             <option value="Opportunity">Opportunity</option>
                                             <option value="Optional">Optional</option>
                                             <option value="Critical">Critical</option>
                                             <option value="Meeting">Meeting</option>
                                             <option value="Social">Social</option>
                                             <option value="Time Off">Time Off</option>
                                             <option value="Private">Private</option>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label" style="width: 100%;text-align: left;">Contact</label>
                                          <select name="econtacts" id="econtacts" class="form-control">
                                             <?php 

                                                while($econtact_list = $econtact_query->fetch_assoc()) {
                                                   echo '<option value="'.$econtact_list['id'].'">'.$econtact_list['name'].'</option>';
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label" style="width: 100%;text-align: left;">Lead</label>
                                          <select name="eleads" id="eleads" class="form-control">
                                             <?php 

                                                while($eleads_list = $eleadsq_query->fetch_assoc()) {
                                                   echo '<option value="'.$eleads_list['id'].'">'.$eleads_list['fname'].'</option>';
                                                }
                                             ?>
                                          </select>
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
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <?php include('includes/footer.inc');?>
      </div>
      <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="https://election.news7tamilvideos.com/editor/user/js/select2.min.js"></script>
      <script src="assets/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script src="http://demos.codexworld.com/bootstrap-datetimepicker-add-date-time-picker-input-field/js/bootstrap-datetimepicker.min.js"></script>
      <script>
         function delete_event(eid) {
            swal({
              title: "Are you sure?",
              text: "Do you want to delete this Event !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: 'backend/deleteevent.php',
                    type: 'POST',
                    data:{
                        id:eid
                    },
                    async:false,
                    success: function(data){
                        var result = JSON.parse(data);
                        if(result.status=='success') {
                           swal({
                             title: "Success",
                             text: "Event Deleted successfully!!!",
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
                             text: "Failed to delete Event details!!",
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
         function show_event(eid) {
            $.ajax({
              url: 'backend/getevent.php',
              type: 'POST',
              data:{
                  id:eid
              },
              async:false,
              success: function(data){
                  var result = JSON.parse(data);
                  $('#viewsal').modal('show');
                  $('#co_name').html(result.title);
                  $('#etitle').val(result.title);
                  $('#eid').val(result.eid);
                  $('#co_acc').html(result.start);
                  $('#estart').val(result.start);
                  $('#co_stage').html(result.end);
                  $('#eend').val(result.end);
                  $('#co_amount').html(result.location);
                  $('#elocation').val(result.location);
                  $('#co_prop').html(result.type);
                  $('#eevent').val(result.type);
                  $('#co_cnts').html(result.cname);
                  $('#econtacts').val(result.cid);
                  $('#co_leds').html(result.lname);
                  $('#eleads').val(result.lid);
                  $('#ccon').html(result.created_at);
                  $('#remv').html('<button style="margin-left:5px;" onclick="delete_event('+result.event_id+')" class="btn btn-danger pull-left">Delete</button>');
                  $('#edit').html('<button onclick="edit_event()" class="btn btn-warning pull-left">Edit</button>');

              },
              error: function(xhr, textStatus, errorThrown) {
                  alert('Network Error, Try Later!!');
                  return false;
              }
            });
         }
         function edit_event() {
            $('#viewsal').modal('hide');
            $('#editsal').modal('show');
         }
         $('#newevent').submit(function(e){
            e.preventDefault();
            var all_res = document.getElementById('newevent');
            var form_data = new FormData(all_res);
            $.ajax({
              url:"backend/addevent.php",
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
                          text: "Event Created successfully!!!",
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
                          text: "Failed to create event!!!",
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

         $('#enewevent').submit(function(e){
            e.preventDefault();
            var all_res = document.getElementById('enewevent');
                var form_data = new FormData(all_res);
                $.ajax({
                    url:"backend/updateevent.php",
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
                             text: "Event Updated successfully!!!",
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
                             text: "Failed to update Event details!!",
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

         $("#start").datetimepicker({
             format: 'yyyy-mm-dd hh:ii',
             autoclose: true
         });
         $("#end").datetimepicker({
             format: 'yyyy-mm-dd hh:ii',
             autoclose: true
         });

      function calndr() {         
         /* initialize the external events
          -----------------------------------------------------------------*/
           var calndr = $('#external-events .fc-event');
         
           $(calndr).each(function () {
             // store data so the calendar knows to render an event upon drop
             $(this).data('event', {
                 title: $.trim($(this).text()), // use the element's text as the event title
                 stick: true // maintain when user navigates (see docs on the renderEvent method)
             });
         
             // make the event draggable using jQuery UI
             $(this).draggable({
                 zIndex: 999,
                 revert: true, // will cause the event to go back to its
                 revertDuration: 0  //  original position after the drag
             });
         
         });
         
         /* initialize the calendar
          -----------------------------------------------------------------*/
          var calender = $('#calendar');
         $(calender).fullCalendar({
             header: {
                 left: 'prev,next today',
                 center: 'title',
                 right: 'month,agendaWeek,agendaDay,listMonth'
             },
             eventClick: function(info) {
                console.log('Event: ' + info.event);
              },
             defaultDate: '2019-12-12',
             navLinks: true, // can click day/week names to navigate views
             businessHours: true, // display business hours
             editable: true,
             selectable:true,
             select: function (start, end, jsEvent, view) {
                    $('#addsal').modal('show');
                },
             droppable: true, // this allows things to be dropped onto the calendar
             drop: function () {
                 // is the "remove after drop" checkbox checked?
                 if ($('#drop-remove').is(':checked')) {
                     // if so, remove the element from the "Draggable Events" list
                     $(this).remove();
                 }
             },
             events: <?php print json_encode($result);?>
         });
         }
         calndr();
         $(document).ready(function(){
            $("#contacts").select2();
            $("#leads").select2();
            $('#teams').select2();
         });
      </script>
   </body>
</html>

