<?php
    require "../php/functions.php";
    if(!isset($_SESSION['login'])){
        header("Location: ../loginPage.php");
    }
    $count = getNotificationCount($db);
    $countW = getNotificationCountWait($db);
    $countC = getNotificationCountClient($db);
    $countU = getNotificationCountUser($db);
    if(!isset($_SESSION['countNotifW']) || $_SESSION['countNotifW']==0 ){
      $_SESSION['countNotifW']=$countW;
    }
    if(!isset($_SESSION['countNotifC']) || $_SESSION['countNotifC']==0 ){
      $_SESSION['countNotifC']=$countC;
    }
    if(!isset($_SESSION['countNotifU']) || $_SESSION['countNotifU']==0 ){
      $_SESSION['countNotifU']=$countU;
    }
    // insertion during access
    if(isset($_SESSION['countNotifC']) && $_SESSION['countNotifC'] !=$countC){
      $_SESSION['countNotifC']+=$countC;
    }
    if(isset($_SESSION['countNotifW']) && $_SESSION['countNotifW'] !=$countW){
      $_SESSION['countNotifW']+=$countW;
    }
    if(isset($_SESSION['countNotifU']) && $_SESSION['countNotifU'] !=$countU){
      $_SESSION['countNotifU']+=$countU;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maui Snorkeling</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" onkeyup="searchBy(this.value)">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      <!-- SET ON CLICK HERE -->
        <a class="nav-link" data-toggle="dropdown" href="#"> 
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notifCnt"><?php echo $count !=0 ?$count :''; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="text-align:center">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> <?php echo $_SESSION['countNotifW'] !=0 ?$_SESSION['countNotifW'].' Wait Added' :'No Notification'; ?>
          </a>
          <a href="client.php" class="dropdown-item">
          <i class="nav-icon fas fa-user-tie"></i> <?php echo $_SESSION['countNotifC'] !=0 ?$_SESSION['countNotifC'].' Clients Added' :'No Notification'; ?>
          </a>
          <a href="user.php" class="dropdown-item">
          <i class="nav-icon fas fa-user"></i> <?php echo $_SESSION['countNotifU'] !=0 ?$_SESSION['countNotifU'].' Users Added' :'No Notification'; ?>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script>
    function updateStatus(){
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
              document.getElementById("notifCnt").innerHTML=this.responseText;
          }
      }
      xmlhttp.open("GET","../php/updateNotificationStatus.php",true);
      xmlhttp.send();
    }
    </script>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Maui Snorkeling</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/<?php echo $_SESSION['img'];?>" style="height:35px;max-width:500px;width: expression(this.width > 500 ? 500: true);" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../accountSettings.php" class="d-block"><?php echo $_SESSION['username'];?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="../index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Waitlist
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="client.php" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Client List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="user.php" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="emailtemplates.php" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Email Templates
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Forms
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../forms/waitlistForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waitlist Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/clientForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/userForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Form</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../php/logout.php" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Waitlist</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Waitlist</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <input type="checkbox" value="" id="selectAll" onclick="selectAll(this)"> Select All
        
        <button type="button" class="btn btn-success" style="float:right;margin-bottom:5px;margin-left:5px;" onclick="exportDataModal()">Export</button>
        <button type="button" class="btn btn-primary" style="float:right;margin-bottom:5px;margin-left:5px;"  onclick="checkSend()">Send</button>
        <button type="button" class="btn btn-primary" style="float:right;margin-bottom:5px"  onclick="checkApprove()">Approve</button>
        <a href="#" onclick="copyToClip()" data-toggle="tooltip" title="Copy Waiting List Form URL"><i class="fas fa-clipboard" style="float:right;margin-right:1.5rem;margin-top:0.45rem"></i></a>
        
        
        <input type="date" id="endDate" onchange="searchBy('')" value="" style="float:right;margin-right:1rem;margin-top:0.25rem;width:125px">
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">End Date</label>
        <input type="date" id="startDate" onchange="searchBy('')" value="" style="float:right;margin-right:1rem;margin-top:0.25rem;width:125px">
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Start Date</label>
        <select id="actName" onchange="searchBy('')" style="float:right;margin-right:1rem;margin-top:0.25rem;width:100px">
          <option value="" selected>Select</option>
          <?php getAllActivity($db);?>
        </select>
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Activity Name</label>
        <select id="type" style="float:right;margin-right:1rem;margin-top:0.25rem">
                  <option value="name">Name</option>
                  <option value="phone">Phone</option>
                  <option value="email">Email</option>

        </select>
        
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Search By</label>
        
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col"></th>
              <th  scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(2)')">Name</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(3)')">Phone</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(4)')">Email</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(5)')">Activity Name</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(6)')">Start Date</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(7)')">End Date</th>
            </tr>
          </thead>
          <form method="post" action="" onsubmit="return sendEmail();">
          <tbody id="searchTable" style="color:gray">
            <?php 
            displayAllList($db);
            updateNotificationStatusWait($db);
            ?>
          </tbody>
        </table>
      </div>
    </section>
    
    <script>
      function sendEmail(){
        var list=[];
        var ctr=0;
        var subject = document.getElementById("subject1").value;
        var message = document.getElementById("text1").value;
        var checkboxes = document.getElementsByName('list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked == true){
                list[ctr++]=checkboxes[i].value;
            }
        }
        // alert(subject,message);
        $.ajax({
            type: 'post',
            url: '../php/waitlist/sendEmail.php',
            data:{
              subject:subject,
              message:message,
              list:list,
            },
            success:function(response){
              alert(response);
              if(response == 'Email Sent'){
                  location.reload();
              }
            }
          });
          return false;
      }
      function updateListInfo(){
        var waitID=document.getElementById('waitID').value;
        var name=document.getElementById('name').value;
        var phone=document.getElementById('phone').value;
        var email=document.getElementById('email').value;
        var sdate=document.getElementById('sdate').value;
        var edate=document.getElementById('edate').value;
        var passengers=document.getElementById('passengers').value;
        var aname=document.getElementById('aname').value;
        var notes=document.getElementById('notes').value;

        $.ajax({
          type: 'post',
          url: '../php/waitlist/updateList.php',
          data:{
            waitID:waitID,
            name:name,
            phone:phone,
            email:email,
            sdate:sdate,
            edate:edate,
            passengers:passengers,
            aname:aname,
            notes:notes
          },
          success:function(response){
            alert(response);
            if(response == 'Success'){
              $(function () {
                $('#waitInfo').modal('toggle');
              });
              location.reload();
            }
          }
        });
        return false;
      }
      function editList(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("editInfoBody").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../php/waitlist/editWaitlistInfo.php?id="+id,true);
        xmlhttp.send();
      }
      function copyToClip(){
        str="https://waitinglist.klbsolutionsllc.com/forms/waitlistForm.php";
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert("Copied the text: " + el.value);
      }
      function info(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("informationBody").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../php/waitlist/printWaitlistInfo.php?id="+id,true);
        xmlhttp.send();
      }
      function checkSend(){
        checkboxes = document.getElementsByName('list[]');
        ctr=0;
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked == true){
                ctr++;
            }
        }
        if(ctr==0){
            alert("Nothing to Send");
            return;
        }else{
          $(document).ready(function(){
              $("#emailTemplate").modal();
          });
        }
      }
      function checkApprove(){
        var list=[];
        var ctr = 0;
        var checkbox = document.getElementsByName('list[]');
        var checkbox1= document.getElementsByName('waitlist_id[]');
        for(var i=0, n=checkbox.length;i<n;i++) {
          if(checkbox[i].checked == true){
            list[ctr]=checkbox1[i].value;
            ctr++;
          }
        }
        if(ctr==0){
            alert("Nothing to Approve");
            return;
        }else{
          if(confirm("Are you sure you want to approve?")){
            $.ajax({
          type: 'post',
          url: '../php/waitlist/updateApproval.php',
          data:{
            list:list,
          },
          success:function(response){
            alert(response);
            if(response == 'Approved'){
              location.reload();
            }
          }
        });
        return false;
          }
        }
      }
      function exportDataModal(){
        var list=[];
        var ctr = 0;
        var checkbox = document.getElementsByName('list[]');
        var checkbox1= document.getElementsByName('waitlist_id[]');
        for(var i=0, n=checkbox.length;i<n;i++) {
          if(checkbox[i].checked == true){
            list[ctr]=checkbox1[i].value;
            ctr++;
          }
        }
        if(ctr==0){
          $(document).ready(function(){
              $("#exportData").modal();
          });
        }else{
          if(confirm("Are you sure you want to export selected item?")){
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                  window.location="../php/export.php";
                }
            }
            xmlhttp.open("GET","../php/waitlist/exportWaitlist.php?list="+list,true);
            xmlhttp.send();
          } 
        }
      }
      function exportDataByService(){
        var serv = document.getElementById("sname").value;
        var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                  window.location="../php/export.php";
                }
            }
            xmlhttp.open("GET","../php/waitlist/exportDataByService.php?service="+serv,true);
            xmlhttp.send();
      }
      function selectAll(source) {
        checkboxes = document.getElementsByName('list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }
      function searchBy(name){//change to ajax
        var type = document.getElementById("type").value;
        var aname = document.getElementById("actName").value;
        var sdate = document.getElementById("startDate").value;
        var edate = document.getElementById("endDate").value;
        $.ajax({
          type: 'get',
          url: '../php/waitlist/searchWaitlist.php',
          data:{
            name:name,
            type:type,
            aname:aname,
            sdate:sdate,
            edate:edate,

          },
          success:function(response){
            document.getElementById("searchTable").innerHTML=response;
          }
        });
        return false;
    }
      function setEmail(str){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("confirmTemplate").innerHTML=this.responseText;
              document.getElementById("subject1").value =document.getElementById("emailsub").value;
              document.getElementById("text1").value =document.getElementById("emailmes").value;
            }
        }
        xmlhttp.open("GET","../php/emailTemplates/getTemplates.php?tempName="+str,true);
        xmlhttp.send();
    }
    </script>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.MODAL -->
  <div class="modal fade" id="emailTemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
          <div class="form-group">
              <label for="exampleFormControlInput1">Template Name</label>
              <select id="tempname" onchange="setEmail(this.value)">
                  <option value="" disabled selected>Select Template</option>
                  <?php displayTemplates($db)?>
              </select>
          </div>
          <div id="confirmTemplate">
          </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Subject</label>
                  <input type="text" class="form-control" id="subject1" name="subject1" placeholder="Subject" required>
              </div>
              <div class="form-group">
                  <label for="exampleFormControlTextarea1">Message</label>
                  <textarea class="form-control" name="text1" id="text1" rows="3" required></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send Email</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exportData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Export By Activity Name</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
          <div class="form-group">
              <label for="exampleFormControlInput1">Activity Name</label>
              <select id="sname" required>
                    <?php getAllActivity($db)?>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="exportDataByService()">Export Data</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addemailTemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Email Template</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../php/addTemplate.php" method="post">
          <div class="form-group">
              <label for="exampleFormControlInput1">Template Name</label>
              <input type="text" class="form-control" name="TemplateName" placeholder="Template Name" required>
          </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Subject</label>
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                  <label for="exampleFormControlTextarea1">Message</label>
                  <textarea class="form-control" name="message" rows="3" required></textarea required>
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="addTemplate">Add Template</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Information</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="margin:0 auto">
          <div id="informationBody">
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="waitInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Information</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body" style="margin:0 auto">
        <form method="post" action="" onsubmit="return updateListInfo();">
          <div id="editInfoBody">
          
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>MAUI SNORKELING &copy; 2020.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
