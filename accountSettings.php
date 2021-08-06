<?php
    require "php/functions.php";
    if(!isset($_SESSION['login'])){
        header("Location: loginPage.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maui Snorkeling Lani Kai | Account Settings</title>
  <link rel="icon" href="./dist/img/TURTLE.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
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
          <a href="./pages/waitinglist.php" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> <?php echo $_SESSION['countNotifW'] !=0 ?$_SESSION['countNotifW'].' Wait Added' :'No Notification'; ?>
          </a>
          <a href="./pages/client.php" class="dropdown-item">
          <i class="nav-icon fas fa-user-tie"></i> <?php echo $_SESSION['countNotifC'] !=0 ?$_SESSION['countNotifC'].' Clients Added' :'No Notification'; ?>
          </a>
          <a href="./pages/user.php" class="dropdown-item">
          <i class="nav-icon fas fa-user"></i> <?php echo $_SESSION['countNotifU'] !=0 ?$_SESSION['countNotifU'].' Users Added' :'No Notification'; ?>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li>
        <a class="nav-link" href="#"> 
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
      xmlhttp.open("GET","./php/updateNotificationStatus.php",true);
      xmlhttp.send();
    }
    </script>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/TURTLE.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8;margin-top:7px">
      <span class="brand-text font-weight-bold" ><?php echo $businessName; ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/<?php echo $_SESSION['img'];?>" style="height:35px;max-width:500px;width: expression(this.width > 500 ? 500: true);" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username'];?></a>
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
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/waitinglist.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Waitlist
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/client.php" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Client List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/user.php" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/emailtemplates.php" class="nav-link">
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
                <a href="./forms/waitlistForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waitlist Form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./forms/clientForm.php" target="_blank" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client Form</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="./forms/userForm.php" target="_blank" class="nav-link">
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
                <a href="./pages/archive/clientsArchive.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients Archive</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }?>
          <li class="nav-item">
            <a href="php/logout.php" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Account Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Account Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="myTable">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" >
          <div class="col-6" style="text-align:right">
            <img src="dist/img/<?php echo $_SESSION['img'];?>" style="height:400px;max-width:400px;width: expression(this.width > 500 ? 500: true)" id="profPic" class="img-thumbmail" alt="User Image">
          </div>
        
        <div class="col-auto">
          <table table class="table" style="width:300px;">
            <thead>
                <br><br>
            </thead>
            <tbody >
            <br><br>
                <tr>
                    <td>Username</td>
                    <td><?php echo $_SESSION['username']; ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#editUser" ><i class="fas fa-edit"></i></a></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><?php echo $_SESSION['pass']; ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#editPass"><i class="fas fa-edit"></i></a></td>
                </tr> 
                <tr>
                    <td>Email</td>
                    <td><?php echo $_SESSION['email']; ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#editEmail"><i class="fas fa-edit"></i></a></td>
                </tr> 
                <tr>
                    <td>Profile Photo</td>
                    <td><?php echo $_SESSION['img']; ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#editImage"><i class="fas fa-edit"></i></a></td>
                </tr> 
            </tbody>
            </table>
        </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <script>
      //UPDATE EMAIL
      function updateEmail(){
        var email = document.getElementById("email").value;
          $.ajax({
            type: 'post',
            url: './php/accnt/updateEmail.php',
            data:{
              email:email,
            },
            success:function(response){
              if(response == 'Email Updated'){
                toastr.success(response);
                $( "#myTable" ).load( "accountSettings.php #myTable" );
                $('.modal').modal('hide');
                document.getElementById("email").value="";
              }else{
                toastr.error(data);
              }
            }
          });
          return false;
      }
      //UPDATE USERNAME
      function updateUsername(){
        var username = document.getElementById("username").value;
          $.ajax({
            type: 'post',
            url: './php/accnt/updateUsername.php',
            data:{
              username:username,
            },
            success:function(response){
              if(response == 'Username Updated'){
                toastr.success(response);
                $( "#myTable" ).load( "accountSettings.php #myTable" );
                $('.modal').modal('hide');
                document.getElementById("username").value="";
              }else{
                toastr.error(data);
              }
            }
          });
          return false;
      }
      //UPDATE PASSWORD
      function updatePassword(){
        var password = document.getElementById("password").value;
          $.ajax({
            type: 'post',
            url: './php/accnt/updatePassword.php',
            data:{
              password:password,
            },
            success:function(response){
              if(response == 'Password Updated'){
                toastr.success(response);
                $( "#myTable" ).load( "accountSettings.php #myTable" );
                $('.modal').modal('hide');
                document.getElementById("password").value="";
              }else{
                toastr.error(data);
              }
            }
          });
          return false;
      }
      //UPDATE PROFILE PICTURE
      function updateProfile(){
        var name = document.getElementById("file").value;
        name = name.split("\\").pop();
        document.getElementById("title").value=name;
        $("form#data").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: './php/accnt/updateProfile.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                if(data == "File Sucessfully uploaded"){
                  toastr.success(data);
                  $( "#myTable" ).load( "accountSettings.php #myTable" );
                  $('.modal').modal('hide');
                  document.getElementById("file").value="";
                }else{
                  toastr.error(data);
                }
            },
            cache: false,
            contentType: false,
            processData: false
            });
        });
          return false;
      }
    </script>

    <!--MODAL FOR UPDATES-->
<!-- MODAL FOR USERNAME -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Username</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" onsubmit="return updateUsername();">
        <div class="modal-body">
              <div class="form-group">
                  <label for="exampleFormControlInput1">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Username" required>
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="editUser">Update Username</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- MODAL FOR PASSWORD -->
  <div class="modal fade" id="editPass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" onsubmit="return updatePassword();">
        <div class="modal-body">
              <div class="form-group">
                  <label for="exampleFormControlInput1">Password</label>
                  <input type="text" class="form-control" id="password" placeholder="Password" required>
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="editPass">Update Password</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!-- MODAL FOR EMAIL -->
  <div class="modal fade" id="editEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Email</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" onsubmit="return updateEmail();">
        <div class="modal-body">
              <div class="form-group">
                  <label for="exampleFormControlInput1">Email</label>
                  <input type="text" class="form-control" id="email" placeholder="Email" required>
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="editPass">Update Email</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!-- MODAL FOR PROFILE -->
  <div class="modal fade" id="editImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" id="data" method="post" enctype="multipart/form-data">
        <div class="modal-body" >
              <div class="form-group" >
                  <input type="file" accept="image/png, image/jpeg" name="file" id="file" required>
                  <input type="text" name="title" id="title" style="display:none">
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="updateProfile()" name="editPass">Update Photo</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- content end-->
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>MAUI SNORKELING LANI KAI &copy; 2020.</strong>
    All rights reserved.
    <a href="./pages/PrivacyPolicy.php" target="_blank" class="text-secondary" style="margin-left:45%;border:none;padding:0;">Privacy Policy</a>
    <a href="./pages/PrivacyPolicy.php" target="_blank" class="text-secondary" style="margin-left:2%;border:none;padding:0;">Terms of Use</a>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script>
  toastr.options.progressBar = true;
  toastr.options.preventDuplicates = true;
  toastr.options.closeButton = true;
</script>
</body>
</html>
