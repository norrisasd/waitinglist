<?php
    require "../../php/functions.php";
    if(!isset($_SESSION['login'])){
        header("Location: ../../loginPage.php");
    }
    if($_SESSION['access']!=1){
        header("Location: ../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maui Snorkeling Lani Kai</title>
  <link rel="icon" href="../../dist/img/TURTLE.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
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
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index.php" class="nav-link">Home</a>
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
              <select id="type" style="float:right;margin-right:1rem;">
                  <option value="client_name">Name</option>
                  <option value="client_phone">Phone</option>
                  <option value="client_email">Email</option>
                  <!-- <option value="client_date_created">Date Created</option>
                  <option value="client_dnd">DND</option>
                  <option value="client_enabled">Enabled</option> -->
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
          <a href="waitinglist.php" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> <?php echo $_SESSION['countNotifW'] !=0 ?$_SESSION['countNotifW'].' Wait Added' :'No Notification'; ?>
          </a>
          <a href="#" class="dropdown-item">
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
        <a class="nav-link" href="../../accountSettings.php"> 
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
      xmlhttp.open("GET","../../php/updateNotificationStatus.php",true);
      xmlhttp.send();
    }
    </script>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../../dist/img/TURTLE.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8;margin-top:7px">
      <span class="brand-text font-weight-bold" ><?php echo $businessName; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/<?php echo $_SESSION['img'];?>" style="height:35px;max-width:500px;width: expression(this.width > 500 ? 500: true);" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../../accountSettings.php" class="d-block"><?php echo $_SESSION['username'];?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" oninput="w3.filterHTML('#myTable', '.tableItem', this.value)" placeholder="Search" aria-label="Search">
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
            <a href="../../index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../waitinglist.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Waitlist
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../client.php" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Client List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../user.php" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../emailtemplates.php" class="nav-link">
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
                <a href="../../forms/waitlistForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waitlist Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../forms/clientForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client Form</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="../../forms/userForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Form</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-archive" aria-hidden="true"></i>
              <p>
                Archive
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients Archive</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../../php/logout.php" class="nav-link">
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
            <h1>Client Archive</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Client List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <input type="checkbox" value="" id="selectAll" onclick="selectAll(this)" style="margin-left:10px"> Select All
        <button type="button" class="btn btn-danger" style="margin-bottom:5px;margin-left:10px"  onclick="checkDelete()">Delete</button>
        <button type="button" class="btn btn-primary" style="margin-bottom:5px;margin-left:5px"  onclick="checkEnable()">Unarchive</button>
        <button type="button" class="btn btn-success" style="margin-bottom:5px;margin-left:5px;" onclick="exportDataModal()">Export</button>
        <select id="dndFilter" class="form-control" onchange="searchBy('')" style="float:right;margin-right:1rem;width:100px">
          <option value="" selected>Select</option>
          <option value="1">Check</option>
          <option value="0">Uncheck</option>
        </select>
        <label style="float:right;margin-right:1rem;">Filter DND</label>
        <input type="date" id="dateCreated" class="form-control" onchange="searchBy('')" value="" style="float:right;margin-right:1rem;width:140px">
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Date Created</label>
        <div style="overflow-x:auto;">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col"></th>
              <th  scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(2)')">Name</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(3)')">Phone</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(4)')">Email</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(5)')">Date Created</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(6)')">DND</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(7)')">Status</th>
              <th></th>
            </tr>
          </thead>
          <form method="post" action="" onsubmit="return deleteClient();">
          <tbody id="searchTable">
            <?php 
              displayAllClientsDisabled($db);
            ?>
          </tbody>
          <button type="submit" id="delCli" style="display:none"></button>
          </form>
        </table>
        </div>
      </div>
    </section>
    
    <script>
      //AUTO COPY TO CLIPBOARD -NOT USED
    function copyToClip(){
        str="https://waitinglist.klbsolutionsllc.com/forms/clientForm.php";
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert("Copied the text: " + el.value);
      }
    //UPDATE DND CHECKBOX AND DND STATUS IN DB
    function updateDND(id){
      var cb = document.getElementById(id);
      dnd = cb.checked?1:0;
      if(confirm("Are you sure you want to update DND?")){
        $.ajax({
          type:'post',
          url: '../../php/client/updateDND.php',
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
    //FOR BULK UNARCHIVING
    function checkEnable(){
      var list=[];
      var ctr = 0;
      var checkboxes = document.getElementsByName('list[]');
      for(var i=0, n=checkboxes.length;i<n;i++) {
          if(checkboxes[i].checked == true){
              list[ctr++]=checkboxes[i].value;
          }
      }
      if(ctr == 0){
        toastr.error("Nothing to Unarchive!");
        return;
      }
      if(confirm("Are you sure you want to enable this selected client?")){
        $.ajax({
          type:'post',
          url:'../../php/client/enableClient.php',
          data:{
              list:list,
          },
          success:function(response){
            if(response == "Enabled"){
              toastr.success("Unarchived");
              $.ajax({
                type:'post',
                url:'../../php/display/clientArchive.php',
                success:function(response){
                  document.getElementById("searchTable").innerHTML=response;
                }
              });
              document.getElementById("selectAll").checked=false;
            }else{
              toastr.error(response);
            }
          }

        });
        return false;
      }
    }
    //FOR INDIVIDUAL UNARCHIVING
    function setStatus(id){
      var list=[];
      list[0]=id;
      if(confirm("Are you sure you want to enable this client?")){
        $.ajax({
          type:'post',
          url:'../../php/client/enableClient.php',
          data:{
              list:list,
          },
          success:function(response){
            if(response == "Enabled"){
              toastr.success("Unarchived");
              $.ajax({
                type:'post',
                url:'../../php/display/clientArchive.php',
                success:function(response){
                  document.getElementById("searchTable").innerHTML=response;
                }
              });
              $('.modal').modal('hide');
            }else{
              toastr.error(response);
            }
          }

        });
        return false;
      }

    }
    //FOR MODAL ADDING CLIENT
    function addClient(){
        var name=document.getElementById('name').value;
        var phone=document.getElementById('phone').value;
        var email=document.getElementById('email').value;

        $.ajax({
          type: 'post',
          url: '../../php/client/addClient.php',
          data:{
            name:name,
            phone:phone,
            email:email,
          },
          success:function(response){
            alert(response);
            if(response == 'Success')
              location.reload();
          }
        });
        return false;
      }
      //UPDATING CLIENT INFO
      function editClientInfo(){
        var clientID=document.getElementById("clientID").value;
        var name=document.getElementById("name").value;
        var phone=document.getElementById("phone").value;
        var email=document.getElementById("email").value;
        var cb =document.getElementById("dnd");
        cb = cb.checked?1:0;
        $.ajax({
            type: 'post',
            url: '../../php/client/updateClient.php',
            data:{
              id:clientID,
              name:name,
              phone:phone,
              email:email,
              dnd:cb,
            },
            success:function(response){
              if(response == 'Updated'){
                toastr.success("Information Updated");
                $.ajax({
                  type:'post',
                  url:'../../php/display/clientArchive.php',
                  success:function(response){
                    document.getElementById("searchTable").innerHTML=response;
                  }
                });
                $('.modal').modal('hide');
              }
            }
          });
          return false;
      }
      //MODAL SETUP FOR UPDATE
      function editClient(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("editInfoBody").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../../php/client/editClientInfo.php?id="+id,true);
        xmlhttp.send();
      }
      //CLIENT INFO BOX
      function info(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("informationBody").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../../php/client/printClientInfo.php?id="+id,true);
        xmlhttp.send();
      }
      //FOR DELETING CLIENT 
      function deleteClient(){
        var list=[];
        var ctr=0;
        var checkboxes = document.getElementsByName('list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked == true){
                list[ctr++]=checkboxes[i].value;
            }
        }
        $.ajax({
            type: 'post',
            url: '../../php/client/deleteClient.php',
            data:{
              list:list,
            },
            success:function(response){
              if(response == 'Deleted'){
                  toastr.success("Row Deleted!");
                  $.ajax({
                    type:'post',
                    url:'../../php/display/clientArchive.php',
                    success:function(response){
                      document.getElementById("searchTable").innerHTML=response;
                    }
                  });
              }
            }
          });
          return false;
      }
      //FOR CHECKING IF THERE ARE CLIENTS TO BE DELETED
      function checkDelete(){
        checkboxes = document.getElementsByName('list[]');
        ctr=0;
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked == true){
                ctr++;
            }
        }
        if(ctr==0){
            toastr.error("Nothing to Delete");
            return;
        }else{
          if(confirm("Are you sure you want to delete this clients?")){
            document.getElementById("delCli").click();
          }
        }
      }
      //CLIENTS THAT ARE DISABLED EXPORT
      function exportDataModal(){
        var list=[];
        var ctr = 0;
        var checkbox = document.getElementsByName('list[]');
        var checkbox1= document.getElementsByName('waitlist_id[]');
        for(var i=0, n=checkbox.length;i<n;i++) {
          if(checkbox[i].checked == true){
            list[ctr]=checkbox[i].value;
            ctr++;
          }
        }
        if(ctr==0){
          toastr.error("Nothing to Export");
        }else{
          if(confirm("Are you sure you want to export selected item?")){
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                  window.location="../../php/export.php";
                  toastr.success("Exported Successfully");
                  $.ajax({
                    type:'post',
                    url:'../../php/display/clientArchive.php',
                    success:function(response){
                      document.getElementById("searchTable").innerHTML=response;
                    }
                  });
                  document.getElementById("selectAll").checked=false;
                  
                }
            }
            xmlhttp.open("GET","../../php/client/exportClient.php?list="+list,true);
            xmlhttp.send();
          } 
        }
      }
      //SELECT ALL BOX
      function selectAll(source) {
        checkboxes = document.getElementsByName('list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }
      //FOR FILTER AND SEARCH
      function searchBy(name){
        var type = document.getElementById("type").value;
        var dnd = document.getElementById("dndFilter").value;
        var cdate = document.getElementById("dateCreated").value;
        $.ajax({
          type: 'get',
          url: '../../php/client/searchClientArchive.php',
          data:{
            name:name,
            type:type,
            dnd:dnd,
            cdate:cdate,

          },
          success:function(response){
            document.getElementById("searchTable").innerHTML=response;
          }
        });
        return false;
    }
    </script>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content -->
  <!-- /.content-wrapper -->
  <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div id="informationBody">
            
          </div>
        </div>
      </div>
    </div>
  <div class="modal fade" id="clientInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Information</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
        <form method="post" action="" onsubmit="return editClientInfo();">
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
  <div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Client</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
        <form action="" method="post" onsubmit="return addClient();" autocomplete="off" id="clientForm">
            <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Phone</label>
                <input type="number" class="form-control" name="phone" id="phone" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Add</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  

  <footer class="main-footer">
    <strong>MAUI SNORKELING LANI KAI &copy; 2020.</strong>
    All rights reserved.
    <a href="../PrivacyPolicy.php" target="_blank" class="text-secondary" style="margin-left:45%;border:none;padding:0;">Privacy Policy</a>
    <a href="../TermsAndConditions.php" target="_blank" class="text-secondary" style="margin-left:2%;border:none;padding:0;">Terms of Use</a>
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
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
  toastr.options.progressBar = true;
  toastr.options.preventDuplicates = true;
  toastr.options.closeButton = true;
</script>
</body>
</html>
