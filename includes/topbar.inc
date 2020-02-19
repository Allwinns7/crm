<?php
include('./backend/conn.php');
$user_id = $_SESSION['user_id'];

$messages = "SELECT * FROM `messages` WHERE `to_id`=$user_id AND `read`=1";
$messages_sql = $conn->query($messages);
$message_count = mysqli_num_rows($messages_sql);

$notification = "SELECT * FROM `notifications` WHERE `user_id`=$user_id AND `read`=1";
$notification_sql = $conn->query($notification);
$notification_count = mysqli_num_rows($notification_sql);


?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<header class="main-header">
   <a href="/" class="logo">
   <span class="logo-mini">
   <img src="assets/dist/img/mini-logo.png" alt="">
   </span>
   <span class="logo-lg">
   <img src="assets/dist/img/logo.png" alt="">
   </span>
   </a>
   <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="pe-7s-angle-left-circle"></span>
      </a>
      <a href="#search"><span class="pe-7s-search"></span></a>
      <div id="search">
         <button type="button" class="close">×</button>
         <form>
            <input type="search" value="" placeholder="Search.." />
            <button type="submit" class="btn btn-add">Search...</button>
         </form>
      </div>
      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <li class="dropdown messages-menu" onclick="messagesRead()">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="pe-7s-mail"></i>
               <?php 
               if($message_count>0) {
                  echo "<span class='label label-success' id='msgcnt'>".$message_count."</span>";
                  echo "<ul class='dropdown-menu'><li><ul class='menu'>";
                  while($all_messages = $messages_sql->fetch_assoc()) {
                     $who_send = $all_messages['from_id'];
                     $from_user = "SELECT * FROM users WHERE id=$who_send";
                     $from_sql = $conn->query($from_user);
                     $user_detail = $from_sql->fetch_assoc();
                     echo "<li>
                           <a href='#' class='border-gray'>
                              <div class='pull-left'>
                                 <img src='assets/dist/img/avatar.png' class='img-circle' alt='User Image'>
                              </div>
                              <h4>".$user_detail['username']."</h4>
                              <p>".$all_messages['message']."</p>
                              <span class='badge badge-success badge-massege'><small>".$all_messages['datetime']."</small>
                              </span>
                           </a>
                        </li>";                     
                  }
                  echo "</ul></li></ul>";
               } 
               ?>
               </a>
            </li>
            <li class="dropdown notifications-menu" onclick="notificationRead()">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="pe-7s-bell"></i>
               <?php 
               if($notification_count>0) {
                  echo "<span class='label label-warning' id='ntfcnt'>".$notification_count."</span>";
                  echo "<ul class='dropdown-menu'><li><ul class='menu'>";
                  while($all_notification = $notification_sql->fetch_assoc()) {
                     echo "<li>".$all_notification['notification']."</li>";                     
                  }
                  echo "</ul></li></ul>";
               } 
               ?>
               </a>
            </li>
            <li class="dropdown dropdown-user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="assets/dist/img/avatar5.png" class="img-circle" width="45" height="45" alt="user"></a>
               <ul class="dropdown-menu" >
                  <li>
                     <a href="profile.php">
                     <i class="fa fa-user"></i> User Profile</a>
                  </li>
                  <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
                  <li><a href="logout.php">
                     <i class="fa fa-sign-out"></i> Signout</a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </nav>
</header>