<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php
    require "php/functions.php";
    if(!isset($_SESSION['login'])){
        header("Location: loginPage.php");
    }
    $count = getNotificationCount($db);
    if(!isset($_SESSION['countNotif']) || $_SESSION['countNotif']==0 ){
      $_SESSION['countNotif']=$count;
    }
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Maui Snorkeling</title>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
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
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
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
        <a class="nav-link" data-toggle="dropdown" onclick="updateStatus()" href="#"> 
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notifCnt"><?php echo $count !=0 ?$count :''; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="text-align:center">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> <?php echo $count !=0 ?$count.' Added' :'No Notification'; ?>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
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
      xmlhttp.open("GET","./php/updateNotificationStatus.php",true);
      xmlhttp.send();
    }
    </script>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Maui Snorkeling</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="accountSettings.php" class="d-block"><?php echo $_SESSION['username'];?></a>
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
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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
            <a href="pages/emailtemplates.php" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Email Templates
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/mailbox/mailbox.php" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="php/logout.php" class="nav-link">
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2>Yesterday</h2>
                <h3 style="text-align:center"><?php echo getCountYesterday($db); ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h2>Today</h2>
                <h3 style="text-align:center"><?php echo getCountToday($db); ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h2>This Week</h2>
                <h3 style="text-align:center"><?php echo getCountLastWeek($db); ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h2>Most Recent</h2>
                <h3 style="text-align:center"><?php echo $_SESSION['countNotif']; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="card bg-gradient-success" style="margin:0 auto">
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0" >
                <!--The calendar -->
                <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days"><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">June 2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="05/30/2021" class="day old weekend">30</td><td data-action="selectDay" data-day="05/31/2021" class="day old">31</td><td data-action="selectDay" data-day="06/01/2021" class="day">1</td><td data-action="selectDay" data-day="06/02/2021" class="day">2</td><td data-action="selectDay" data-day="06/03/2021" class="day">3</td><td data-action="selectDay" data-day="06/04/2021" class="day">4</td><td data-action="selectDay" data-day="06/05/2021" class="day weekend">5</td></tr><tr><td data-action="selectDay" data-day="06/06/2021" class="day weekend">6</td><td data-action="selectDay" data-day="06/07/2021" class="day">7</td><td data-action="selectDay" data-day="06/08/2021" class="day">8</td><td data-action="selectDay" data-day="06/09/2021" class="day">9</td><td data-action="selectDay" data-day="06/10/2021" class="day">10</td><td data-action="selectDay" data-day="06/11/2021" class="day">11</td><td data-action="selectDay" data-day="06/12/2021" class="day weekend">12</td></tr><tr><td data-action="selectDay" data-day="06/13/2021" class="day weekend">13</td><td data-action="selectDay" data-day="06/14/2021" class="day">14</td><td data-action="selectDay" data-day="06/15/2021" class="day">15</td><td data-action="selectDay" data-day="06/16/2021" class="day">16</td><td data-action="selectDay" data-day="06/17/2021" class="day">17</td><td data-action="selectDay" data-day="06/18/2021" class="day">18</td><td data-action="selectDay" data-day="06/19/2021" class="day weekend">19</td></tr><tr><td data-action="selectDay" data-day="06/20/2021" class="day weekend">20</td><td data-action="selectDay" data-day="06/21/2021" class="day">21</td><td data-action="selectDay" data-day="06/22/2021" class="day">22</td><td data-action="selectDay" data-day="06/23/2021" class="day">23</td><td data-action="selectDay" data-day="06/24/2021" class="day">24</td><td data-action="selectDay" data-day="06/25/2021" class="day">25</td><td data-action="selectDay" data-day="06/26/2021" class="day weekend">26</td></tr><tr><td data-action="selectDay" data-day="06/27/2021" class="day weekend">27</td><td data-action="selectDay" data-day="06/28/2021" class="day">28</td><td data-action="selectDay" data-day="06/29/2021" class="day">29</td><td data-action="selectDay" data-day="06/30/2021" class="day active today">30</td><td data-action="selectDay" data-day="07/01/2021" class="day new">1</td><td data-action="selectDay" data-day="07/02/2021" class="day new">2</td><td data-action="selectDay" data-day="07/03/2021" class="day new weekend">3</td></tr><tr><td data-action="selectDay" data-day="07/04/2021" class="day new weekend">4</td><td data-action="selectDay" data-day="07/05/2021" class="day new">5</td><td data-action="selectDay" data-day="07/06/2021" class="day new">6</td><td data-action="selectDay" data-day="07/07/2021" class="day new">7</td><td data-action="selectDay" data-day="07/08/2021" class="day new">8</td><td data-action="selectDay" data-day="07/09/2021" class="day new">9</td><td data-action="selectDay" data-day="07/10/2021" class="day new weekend">10</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month active">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year active">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade active" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- DONUT CHART -->
            <!-- /.card -->



        <!-- /.row -->
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = ["Most Recent", "Today", "Yesterdy", "This Week"];
var yValues = [<?php echo $_SESSION['countNotif'] ?>, <?php echo getCountToday($db); ?>, <?php echo getCountYesterday($db); ?>, <?php echo getCountLastWeek($db); ?>];
var barColors = ["red", "green","blue","orange"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Bar Chart"
    }
  }
});
</script>
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
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
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
