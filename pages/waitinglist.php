<?php
    require "../php/functions.php";
    if(!isset($_SESSION['login'])){
        header("Location: ../loginPage.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maui Snorkeling Lani Kai</title>
  <link rel="icon" href="../dist/img/TURTLE.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- TOASTR -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <style>
    .loaderB {
      border: 16px solid #f3f3f3;
      background:white;
      width: 100%;
      height:100%;
      overflow:hidden;
      opacity:75%;
    }
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3c8dbc;
      border-bottom: 16px solid #3c8dbc;
      width: 200px;
      height: 200px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    
    }
    @media only screen and (max-width: 600px){
      
    }
</style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="loaderB" id="logoloader" style="position:absolute;z-index:5;display:none">
      <div class="loader" style="margin:20% 50%"></div>
    </div>
    
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item" style="display:none">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" onkeyup="searchBy(this.value)">
              <select id="type" style="margin-right:1rem;">
                  <option value="name">Name</option>
                  <option value="phone">Phone</option>
                  <option value="email">Email</option>
              </select>
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
      <li>
        <a class="nav-link" href="../accountSettings.php"> 
          <i class="fas fa-cog"></i>
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
      <img src="../dist/img/TURTLE.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8;margin-top:7px">
      <span class="brand-text font-weight-bold" ><?php echo $businessName; ?></span>
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
        <div class="input-group">
          <input class="form-control form-control-sidebar" type="search" oninput="searchDatatable(this.value)" placeholder="Search" aria-label="Search">
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
              <!-- <li class="nav-item">
                <a href="../forms/userForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Form</p>
                </a>
              </li> -->
            </ul>
          </li>
          <?php if($_SESSION['access']==1){
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-archive" aria-hidden="true"></i>
              <p>
                Archive
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./archive/clientsArchive.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients Archive</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }?>
          <li class="nav-item">
            <a href="../php/logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
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
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Waitlist</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- <button type="button" class="btn btn-primary" style="float:right;margin-bottom:5px"  onclick="checkApprove()">Approve</button> -->
        <!-- <a href="#" onclick="copyToClip()" data-toggle="tooltip" title="Copy Waiting List Form URL"><i class="fas fa-clipboard" style="float:right;margin-right:1.5rem;margin-top:0.45rem"></i></a> -->
        
        
        
        <!-- Activity Date -->
        <!-- <select id="type" style="float:right;margin-right:1rem;margin-top:0.25rem">
                  <option value="name">Name</option>
                  <option value="phone">Phone</option>
                  <option value="email">Email</option>
        </select>
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Search By</label> -->
        
              <div class="card-body">
                <div class="row">
                  <div class="col-auto" style="padding-top:1%">
                    <input type="checkbox" value="" id="selectAll" style="margin:5px 0.3%" onclick="selectAll(this)"> 
                  </div>
                  <span style="padding-top:1%">Select All</span>
                  <div class="col-auto" style="padding-top:1%">
                    <button type="button" class="btn btn-primary" style="margin-bottom:5px;margin-left:0.5%;"  onclick="checkSend()">Send</button>
                  </div>
                  <div class="col-auto" style="padding-left:0;padding-top:1%">
                    <button type="button" class="btn btn-success" style="margin-bottom:5px;margin-left:0.3%;margin-right:1%" onclick="exportDataModal()">Export</button>
                  </div>
                  <div class="col-auto">
                    <label for="passengersNum">Passengers</label>
                    <input type="number" class="form-control" id="passengersNum" onchange="searchBy('')" style="margin-right:0.5%;width:70px;" min="0" max="99">
                  </div>
                  <div class="col-auto">
                    <label for="dateCreated">Date Created</label>
                    <input type="date" class="form-control" id="dateCreated" onchange="searchBy('')" value="<?php echo isset($_SESSION['setDate'])?$_SESSION['setDate']:'';?>" style="margin-right:0.5%;width:170px">
                  </div>
                  <div class="col-auto">
                    <label for="displayType">Display </label>
                    <select id="displayType" class="form-control" onchange="searchBy('')" style="margin-right:0.5%;width:170px;">
                        <option value="">All</option>
                        <option value="1">Sent</option>
                        <option value="0">Not Sent</option>
                    </select>
                  </div>
                  <div class="col-auto">
                    <label for="actName">Activity Name</label>
                    <select id="actName" class="form-control" onchange="searchBy('')" style="margin-right:0.5%;width:150px">
                      <option value="" selected>Select</option>
                      <?php getAllActivity($db);?>
                    </select>
                  </div>
                  <div class="col-auto">
                    <label for="endDate">Last Date</label>
                    <input type="date" class="form-control" id="endDate" onchange="searchBy('')" value="" style="margin-right:0.5%;width:170px">
                  </div>
                  <div class="col-auto">
                    <label for="startDate">First Date</label>
                    <input type="date" class="form-control" id="startDate" onchange="searchBy('')" value="" style="margin-right:0.5%;width:170px">
                  </div>
                  <div class="col-auto">
                  <label for="actDate">Activity Date</label>
                    <!-- Start Date -->
                  <input type="text" class="form-control" id="actDate"  value="" style="margin-right:0.5%;background:white;width:200px" readonly>
                 </div>
                </div>
                <div class="row" id="2ndRow">
                  <div class="col" id="beforeLD" style="margin-right:1%;">
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true"></i>
                  </div>
                  
                  
                  <!-- END DATE -->
                 
                </div>
                <table id="myTable" class="table table-bordered table-hover" style="height:100%">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Activity Name</th>
                      <th>Date Created</th>
                      <th>First Date</th>
                      <th>Last Date</th>
                      <th>Passengers</th>
                    </tr>
                  </thead>
                  <tbody id="searchTable">
                    <?php
                      displayAllList($db,'','');
                      updateNotificationStatusWait($db);
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Activity Name</th>
                      <th>Date Created</th>
                      <th>First Date</th>
                      <th>Last Date</th>
                      <th>Passengers</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
      </div>
    </section>
    
    <script>
      function setStatus(id){
        var list=[];
        list[0]=id;
        if(confirm("Are you sure you want to disable this client?")){
          $.ajax({
            type:'post',
            url:'../php/client/disableClient.php',
            data:{
                list:list,
            },
            success:function(response){ 
              if(response == "Disabled"){
                toastr.success("Archived");
                $.ajax({
                  type:'post',
                  url:'../php/display/waitlist.php',
                  success:function(response){
                    $("#myTable").DataTable().destroy();
                    $("#searchTable").html(response);
                    $('#myTable').DataTable({
                      "oLanguage": {
                        "sLengthMenu": "Show Entries _MENU_",
                      },
                        dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
                        "pageLength":10,
                        "paging": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                        "buttons": ["excel", "pdf", "print"]
                      }).buttons().container().appendTo('#beforeLD');
                        
                  }
                });
                $('.modal').modal('hide');
              }else{
                toastr.error("There was an Error!");
              }
            }

          });
          return false;
        }

      }
      function updateDND(id){
      var cb = document.getElementById(id);
      dnd = cb.checked?1:0;
      if(confirm("Are you sure you want to update DND?")){
        $.ajax({
          type:'post',
          url: '../php/client/updateDND.php',
          data:{
            id:id,
            dnd:dnd
          },
          success:function(response){
              if(response != 'Updated'){
                alert(response);
              }else{
                cb.value= dnd;
              }
          }
       });
      }else{
        if(cb.value == 1){
          cb.checked = true;
        }else{
          cb.checked = false;
        }
      }
      
    }
    function turnoffCheck(){
      document.getElementById("canSpam").required=false;
    }
      function sendEmail(){
        var list=[];
        var ctr=0;
        var tempName = document.getElementById("tempname").value;
        var subject = document.getElementById("subject1").value;
        var message = $('#text1').summernote('code');
        var checkboxes = document.getElementsByName('list[]');
        var checkboxes1 = document.getElementsByName('waitlist_id[]');
        var waitIndId='';
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked == true){
                list[ctr++]=checkboxes1[i].value;
            }
        }
        if(ctr == 0){
          waitIndId=document.getElementById("waitIndID").value;
        }else if (ctr > 1){
          if(confirm("You are about to send "+tempName+" to "+ctr+" clients. Would you like to proceed with sending the email?")){

          }else{
            return false;
          }
        }
        $('.modal').modal('hide');
        document.getElementById("logoloader").style.display="block";
        $.ajax({
            type: 'post',
            url: '../php/waitlist/sendEmail.php',
            data:{
              subject:subject,
              message:message,
              list:list,
              waitIndId:waitIndId,
              tempName:tempName,
            },
            success:function(response){
              if(response == 'Email Sent'){
                toastr.success("Email has been sent!");
                $.ajax({
                  type:'post',
                  url:'../php/display/waitlist.php',
                  success:function(response){
                    $("#myTable").DataTable().destroy();
                    $("#searchTable").html(response);
                    $('#myTable').DataTable({
                      "oLanguage": {
                        "sLengthMenu": "Show Entries _MENU_",
                      },
                        dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
                        "pageLength":10,
                        "paging": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                        "buttons": ["excel", "pdf", "print"]
                      }).buttons().container().appendTo('#beforeLD');
                      
                  }
                });
                document.getElementById("logoloader").style.display="none";
                document.getElementById("selectAll").checked=false;
                document.getElementById("canSpam").checked=false;
                document.getElementById("subject1").value='';
                $('#text1').summernote('code','');
                document.getElementById("tempname").selectedIndex = "0";
              }else{
                toastr.error(response);
                document.getElementById("logoloader").style.display="none";
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
            if(response == 'Success'){
              toastr.success("Information Updated");
              $.ajax({
                type:'post',
                url:'../php/display/waitlist.php',
                success:function(response){
                  $("#myTable").DataTable().destroy();
                  $("#searchTable").html(response);
                  $('#myTable').DataTable({
                    "oLanguage": {
                      "sLengthMenu": "Show Entries _MENU_",
                    },
                      dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
                      "pageLength":10,
                      "paging": true,
                      "searching": false,
                      "ordering": true,
                      "info": true,
                      "autoWidth": false,
                      "responsive": true,
                      "buttons": ["excel", "pdf", "print"]
                    }).buttons().container().appendTo('#beforeLD');
                    
                }
              });
              $('.modal').modal('hide');
            }else{
              toastr.error("There was an error!");
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
        str="https://bit.ly/2WC0kMj";
        const el = document.createElement('textarea');
        el.value = str;
        $("#confirmTemplate").append(el);
        el.select();
        document.execCommand('copy');
        $("#confirmTemplate textarea").remove();
        toastr.success("Copied the text: " + el.value);
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
          toastr.error("Nothing to Send");
          return;
        }else{
          if(ctr>1){
            w3.show("#warningBulk");
          }else{
            w3.hide("#warningBulk");
            document.getElementById("canSpam").required=false;
          }
            
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
            toastr.warning("Nothing to Approve");
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
                  toastr.success("Exported List Successfully");
                  $.ajax({
                    type:'post',
                    url:'../php/display/waitlist.php',
                    success:function(response){
                      $("#myTable").DataTable().destroy();
                      $("#searchTable").html(response);
                      $('#myTable').DataTable({
                        "oLanguage": {
                          "sLengthMenu": "Show Entries _MENU_",
                        },
                          dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
                          "pageLength":10,
                          "paging": true,
                          "searching": false,
                          "ordering": true,
                          "info": true,
                          "autoWidth": false,
                          "responsive": true,
                          "buttons": ["excel", "pdf", "print"]
                        }).buttons().container().appendTo('#beforeLD');
                        
                    }
                  });
                  document.getElementById("selectAll").checked=false;
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
                  toastr.success("Exported "+serv+" Successfully");
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
        var displayType = document.getElementById("displayType").value;
        var dateCreated = document.getElementById("dateCreated").value;
        var passengers = document.getElementById("passengersNum").value;
        $.ajax({
          type: 'get',
          url: '../php/waitlist/searchWaitlist.php',
          data:{
            name:name,
            type:type,
            aname:aname,
            sdate:sdate,
            edate:edate,
            startDate:startDate,
            endDate:endDate,
            displayType:displayType,
            dateCreated:dateCreated,
            passengers:passengers,

          },
          success:function(response){
            
            $("#myTable").DataTable().destroy();
            $("#searchTable").html(response);
            $('#myTable').DataTable({
              "oLanguage": {
                "sLengthMenu": "Show Entries _MENU_",
              },
                dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
                "pageLength":10,
                "paging": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["excel", "pdf", "print"]
              }).buttons().container().appendTo('#beforeLD');
                      
          }
        });
        return false;
    }
      function setEmail(str){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              var template = JSON.parse(this.responseText);
              document.getElementById("subject1").value=template.subject;
              $('#text1').summernote('code',template.message);
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
  <div class="modal fade" id="info" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="informationBody">
          
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="emailTemplate" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Email</h5>
          <button type="button" class="btn btn-outline-dark" onclick="w3.hide('#warningBulk')" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body" >
          <div class="form-group">
          <div id="warningBulk" style="display:none">
            <div class="alert alert-warning" role="alert">
              <b>Warning:</b><br>
              <p style="text-align:justify;margin:0">
                Sending bulk emails will likely get them tagged as spam. To eliminate bounce rate, ensure email quality and avoid potential spam triggers!  
              </p> 
            </div>
            <div id="warningAgree">
              <input type="checkbox" id="canSpam" style="margin:3% 2%" required><span>I agree in <a href="TermsAndConditions.php" target="_blank"><u>TERMS AND CONDITIONS</u></a></span>
            </div>
            
          </div>
          
            <br>
              <label for="exampleFormControlInput1">Template Name</label>
              <select id="tempname" onchange="setEmail(this.value)">
                  <option value="" disabled selected>Select Template</option>
                  <?php displayTemplates($db)?>
              </select>
              <a href="#" class="text-secondary" onclick="copyToClip()"  style="margin-left:45%;"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy Link for Booking</a>
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
          <button type="submit" onclick="sendEmail()" class="btn btn-primary">Send Email</button>
          <button type="button" class="btn btn-secondary" onclick="w3.hide('#warningBulk')" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exportData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-file-export"></i> Export By Activity Name</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
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

  <div class="modal fade bd-example-modal-lg" id="addemailTemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
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
                  <textarea name="message" required></textarea required>
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
  
  <div class="modal fade" id="waitInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Information</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
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
    <strong>MAUI SNORKELING LANI KAI &copy; 2020.</strong>
    All rights reserved.
    <a href="./PrivacyPolicy.php" target="_blank" class="text-secondary" style="margin-left:45%;border:none;padding:0;">Privacy Policy</a>
    <a href="./TermsAndConditions.php" target="_blank" class="text-secondary" style="margin-left:2%;border:none;padding:0;">Terms of Use</a>
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
<!-- jquery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<script src="../plugins/popper/popper.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- TOASTR -->
<script src="../plugins/toastr/toastr.min.js"></script>
  <!-- SUMMERNOTE -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
<!-- SUMMERNOTE -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script>
  toastr.options.progressBar = true;
  toastr.options.preventDuplicates = true;
  toastr.options.closeButton = true;
  $('#text1').summernote({
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview']],
    ],
});
  var startDate ='';
  var endDate = '';
  $(function() {
  $('#actDate').daterangepicker({
    opens: 'left',
  }, function(start, end, label) {
    startDate = start.format('YYYY-MM-DD');
    endDate = end.format('YYYY-MM-DD');
    searchBy('');
  });
});
$(function(){
  $('#myTable').DataTable({
    "oLanguage": {
      "sLengthMenu": "Show Entries _MENU_",
    },
      dom: "<'row d-flex flex-row align-items-end'>tr<'row d-flex flex-row align-items-end'<'col-md-8'l><'col-sm-2'i><'col-md-2'p>>",
      "pageLength":10,
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#beforeLD');
});
  function searchDatatable(name){
    $('#myTable').DataTable().search(name).draw();
  }
</script>
</body>
</html>
