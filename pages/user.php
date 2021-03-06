<?php 
    include '../php/functions.php';
    if(!isset($_SESSION['login'])){
    header("Location: ../loginPage");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maui Snorkeling Lani Kai</title>
  <link rel="icon" href="../dist/img/TURTLE.png">
  <script src="https://www.w3schools.com/lib/w3.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- TOASTRS -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
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
          <a href="waitinglist" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> <?php echo $_SESSION['countNotifW'] !=0 ?$_SESSION['countNotifW'].' Wait Added' :'No Notification'; ?>
          </a>
          <a href="client" class="dropdown-item">
          <i class="nav-icon fas fa-user-tie"></i> <?php echo $_SESSION['countNotifC'] !=0 ?$_SESSION['countNotifC'].' Clients Added' :'No Notification'; ?>
          </a>
          <a href="#" class="dropdown-item">
          <i class="nav-icon fas fa-user"></i> <?php echo $_SESSION['countNotifU'] !=0 ?$_SESSION['countNotifU'].' Users Added' :'No Notification'; ?>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li>
        <a class="nav-link" href="../accountSettings"> 
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
    <a href="../" class="brand-link">
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
          <a href="../accountSettings" class="d-block"><?php echo $_SESSION['username'];?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group">
          <input class="form-control form-control-sidebar" oninput="searchDatatable(this.value)"  type="search" placeholder="Search" aria-label="Search">
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
            <a href="../" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="waitinglist" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Waitlist
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="client" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Client List
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="emailtemplates" class="nav-link">
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
                <a href="../forms/waitlistForm" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waitlist Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../forms/clientForm" target="_blank" class="nav-link">
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
                <a href="./archive/clientsArchive" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients Archive</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }?>
          <li class="nav-item">
            <a href="../php/logout" class="nav-link">
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
            <h1>User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card-body">
        <input type="checkbox" value="" style="margin-left:10px;" id="selectAll" onclick="selectAll(this)"> Select All
        <?php
          if($_SESSION['access'] == 1){
            echo '<button type="button" class="btn btn-success" style="margin-bottom:5px;margin-left:10px;" onclick="exportDataModal()">Export</button>
            <a href="#" target="_blank" data-toggle="modal" data-target="#addUser" style="margin:0.2rem 0.5rem;margin-top:0.2rem">ADD USER</a>';
          }
        ?>
        <!-- <a href="#" onclick="copyToClip()" data-toggle="tooltip" title="Copy User Form URL"><i class="fas fa-clipboard" style="float:right;margin-right:1.5rem;margin-top:0.45rem"></i></a> -->
        
        <!-- <select id="type" style="float:right;margin-right:1rem;margin-top:0.25rem">
                  <option value="username">Username</option>
                  <option value="email">email</option>
        </select> -->
        <!-- <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Search By</label> -->
        <table class="table table-bordered table-hover" id="myTable">
          <thead>
            <tr>
              <th></th>
              <th>Username</th>
              <th>Email</th>
              <th>Access</th>
            </tr>
          </thead>
          <form method="post" action="" onsubmit="return deleteClient();">
          <tbody id="searchTable">
            <?php 
              displayAllUser($db);
              updateNotificationStatusUser($db);
            ?>
          </tbody>
          <button type="submit" id="delCli" style="display:none"></button>
          </form>
          <tfoot>
              <th></th>
              <th>Username</th>
              <th>Email</th>
              <th>Access</th>
          </tfoot>
        </table>
        </div>
      </div>
    </section>
    
    <script>
    function refreshTable(){
      $.ajax({
        type:'post',
        url:'../php/display/user.php',
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
    }
    function info(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("informationBody").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../php/user/printUserInfo.php?id="+id,true);
        xmlhttp.send();
    }
    function setAccess(user,type){
      document.getElementById("btnAccess").value=user;
      document.getElementById("radAge").checked=false;
      document.getElementById("radAdm").checked=false;
      document.getElementById("radMod").checked=false;
      if(type == null){//moderator
        document.getElementById("radMod").checked=true;
      }
      if(type == 0){//agent
        document.getElementById("radAge").checked=true;
      }
      if(type == 1){//admin
        document.getElementById("radAdm").checked=true;
      }
    }
    function updateAccess(){
      var user = document.getElementById("btnAccess").value;
      var type = $("input[name=caradioBtnType]:checked","#changeAccess").val();
      $.ajax({
         type:'get',
         url: '../php/user/updateAccess.php',
         data:{
            type:type,
            user:user,
         },
         success:function(response){
           if(response == 'Success'){
             toastr.success(user+"'s Access Updated");
             $(".modal").modal("hide");
             refreshTable();
           }else{
             toastr.error(response);
           }
         }
      });
    }
    function addUser(){
        var username=document.getElementById('username').value;
        var password=document.getElementById('password').value;
        var cpassword=document.getElementById('cpassword').value;
        var type = $("input[name=radioBtnType]:checked","#addUserModal").val();
        if(password != cpassword){
            toastr.error("Password not the same!");
            return false;
        }
        var email=document.getElementById('email').value;

        $.ajax({
          type: 'post',
          url: '../php/user/addUser.php',
          data:{
            username:username,
            password:password,
            email:email,
            type:type
          },
          success:function(response){
            if(response == 'Success'){
              toastr.success("Registered Successfully");
              refreshTable();
              $('.modal').modal('hide');
              document.getElementById("addUserModal").reset();
            }else{
              toastr.error(response);
            }
          }
        });
        return false;
      }
      function removeAdmin(user){
        if(confirm("Are you sure you want to remove "+user+" Sub Admin?")){
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
              if (this.readyState==4 && this.status==200) {
                if(this.responseText== 'Success'){
                  toastr.success(user+" has no access anymore");
                  refreshTable();
                  $('.modal').modal('hide');
                }else{
                  toastr.error(this.responseText);
                }
              }
          }
          xmlhttp.open("GET","../php/user/removeAdmin.php?user="+user,true);
          xmlhttp.send();
        }
      }
      function makeAdmin(user){
        if(confirm("Are you sure you want to make "+user+" Sub Admin?")){
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function() {
              if (this.readyState==4 && this.status==200) {
                if(this.responseText== 'Success'){
                  toastr.success(user+" can access now");
                  refreshTable();
                  $('.modal').modal('hide');
                }else{
                  toastr.error(this.responseText);
                }
              }
          }
          xmlhttp.open("GET","../php/user/makeAdmin.php?user="+user,true);
          xmlhttp.send();
        }
      }
        function copyToClip(){
        str="https://waitinglist.klbsolutionsllc.com/forms/userForm.php";
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert("Copied the text: " + el.value);
      }

      function exportDataModal(){
        var list=[];
        var ctr = 0;
        var checkbox = document.getElementsByName('list[]');
        for(var i=0, n=checkbox.length;i<n;i++) {
          if(checkbox[i].checked == true){
            list[ctr]=checkbox[i].value;
            ctr++;
          }
        }
        if(ctr==0){
          toastr.error("Nothing to Export");
        }else{
          if(confirm("Are you sure you want to export selected item/s?")){
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                  window.location="../php/export.php";
                  toastr.success("Exported List Successfully");
                  refreshTable();
                  document.getElementById("selectAll").checked=false;
                }
            }
            xmlhttp.open("GET","../php/user/exportUser.php?list="+list,true);
            xmlhttp.send();
          } 
        }
      }
      function selectAll(source) {
        checkboxes = document.getElementsByName('list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }
      function searchBy(name){
        var type = document.getElementById("type").value;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("searchTable").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("GET","../php/user/searchUser.php?name="+name+"&type="+type,true);
        xmlhttp.send();
    }
    function editUserInfo(){
      var username = document.getElementById("username1").value;
      var password = document.getElementById("password1").value;
      var email = document.getElementById("email1").value;
      var prevUser = document.getElementById("prevUser").value;
      $.ajax({
        type: 'post',
        url: '../php/user/updateUser.php',
        data:{
          password:password,
          username:username,
          email:email,
          prevUser:prevUser
        },
        success:function(response){
          if(response == 'Updated'){
            toastr.success("Information Updated");
            refreshTable();
            $('.modal').modal('hide');

          }else{
            toast.error(response);
          }
        }
      });
      return false;
    }
    
    function editUser(username){
      var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("editInfoBody").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../php/user/editUserInfo.php?user="+username,true);
        xmlhttp.send();
    }
    </script>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content -->
  <!-- /.content-wrapper -->
  <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="nav-icon fas fa-user"></i> Add User</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
        <form action="" method="post" onsubmit="return addUser();" autocomplete="off" id="addUserModal">
            <div class="form-group">
                <label for="exampleFormControlInput1">Username</label>
                <input type="text" class="form-control" name="name" id="username" placeholder="" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Confirm Password</label>
                <input type="password" class="form-control"  id="cpassword" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="radioBtnType" value="1" id="adminRadioBtn" required>
              <label class="form-check-label" for="adminRadioBtn">
                ADMIN
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="0" name="radioBtnType">
              <label class="form-check-label" for="agentRadioBtn">
                AGENT
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="NULL" name="radioBtnType">
              <label class="form-check-label" for="moderatorRadioBtn">
                MODERATOR
              </label>
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
  <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="informationBody">
          
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="userInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Information</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
        <form method="post" action=""  onsubmit="return editUserInfo();" >
          <div id="editInfoBody">
          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="" >Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="changeAccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Access</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin:auto">
        <div class="col">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="caradioBtnType" value="1" id="radAdm" required>
              <label class="form-check-label" for="radAdm">
                ADMIN
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="0" name="caradioBtnType" id="radAge">
              <label class="form-check-label" for="radAge">
                AGENT
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="NULL" name="caradioBtnType" id="radMod">
              <label class="form-check-label" for="radMod">
                MODERATOR
              </label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateAccess()" class="btn btn-primary" id="btnAccess">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <footer class="main-footer">
    <div class="row">
      <strong>MAUI SNORKELING LANI KAI &copy; 2020.</strong>
      All rights reserved.
      <a href="./PrivacyPolicy" target="_blank" class="text-secondary" style="margin-left:45%;border:none;padding:0;">Privacy Policy</a>
      <a href="./TermsAndConditions" target="_blank" class="text-secondary" style="margin-left:2%;border:none;padding:0;">Terms of Use</a>
    </div>
  </footer>

  <!-- Control Sidebar -->
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
<!-- TOASTRS -->
<script src="../plugins/toastr/toastr.min.js"></script>
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
