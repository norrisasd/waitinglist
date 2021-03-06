<?php
    require "../php/functions.php";
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
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- SUMMERNOTE -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- TOASTR -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/4.0.2/autosize.min.js"></script>
  
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
          <a href="user" class="dropdown-item">
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
          <li class="nav-item">
            <a href="../index" class="nav-link">
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
          <li class="nav-item">
            <a href="user" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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
            <h1>Email Templates</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Email Templates</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card-body">
        <input type="checkbox" value="" style="margin-left:10px" id="selectAll" onclick="selectAll(this)"> Select All
        <button type="button" class="btn btn-danger" style="margin-bottom:5px;margin-left:10px" onclick="confirmDel()">Delete</button>
        <a href="#" style="margin-right:1.5rem;margin-top:0.2rem;margin-left:10px" data-toggle="modal" data-target="#addemailTemplate">Add Template</a>
        <!-- <select id="type" style="float:right;margin-right:1rem;margin-top:0.25rem">
                  <option value="TemplateName">Template Name</option>
                  <option value="subject">Subject</option>
                  <option value="message">Message</option>
        </select>
        <label style="float:right;margin-right:1rem;margin-top:0.25rem;">Search By</label> -->
        <div class="col">
          <div id="beforeLD">
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Export All Data shown in the Table" aria-hidden="true" ></i>
          </div>
        </div>
        <table class="table table-bordered table-hover" id="myTable">
          <thead>
            <tr>
              <th scope="col"></th>
              <th  scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(2)')">Template Name</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(3)')">Subject</th>
              <th scope="col" onclick="w3.sortHTML('#myTable','.tableItem', 'td:nth-child(4)')">Message</th>
            </tr>
          </thead>
          <tbody id="searchTable">
            <?php displayAllTemplates($db)?>
            <button type="submit" id="delTemp" name="delTemp" onclick="deleteTemplate()" style="display:none"></button>
          </tbody>
        </table>
        </div>
      </div>
    </section>
    
    <script>
      function copyToClip(){
        str="https://bit.ly/2WC0kMj";
        const el = document.createElement('textarea');
        el.value = str;
        $("#forCopy").append(el);
        el.select();
        document.execCommand('copy');
        $("#forCopy textarea").remove();
        toastr.success("Copied the text: " + el.value);
      }
      function copyToClip1(){
        str="https://bit.ly/2WC0kMj";
        const el = document.createElement('textarea');
        el.value = str;
        $("#forCopy1").append(el);
        el.select();
        document.execCommand('copy');
        $("#forCopy1 textarea").remove();
        toastr.success("Copied the text: " + el.value);
      }
      function editTemplate(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            var template= JSON.parse(this.responseText);
            // document.getElementById("editTempBody").innerHTML=template.message;
            
            document.getElementById("tempID").value=template.template_id;
            document.getElementById("etname").value=template.TemplateName;
            document.getElementById("esub").value=template.subject;
            $('#emes').summernote('code',template.message);
          }
        }
        xmlhttp.open("GET","../php/emailTemplates/editTemplate.php?id="+id,true);
        xmlhttp.send();

      }
      function addTemplate(){
        var TemplateName=document.getElementById("TemplateName").value;
        var subject=document.getElementById("subject").value;
        var message=$('#message').summernote('code');
        $.ajax({
            type: 'post',
            url: '../php/emailTemplates/addTemplate.php',
            data:{
              TemplateName:TemplateName,
              subject:subject,
              message:message,
            },
            success:function(response){
              if(response == 'Success'){
                  toastr.success("Template Added");
                  $.ajax({
                    type:'post',
                    url:'../php/display/templates.php',
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
                  document.getElementById("addTemplateModal").reset();
              }else{
                toastr.error(response);
              }
            }
          });
          return false;
      }
      function deleteTemplate(){
        var list=[];
        var ctr=0;
        var checkboxes = document.getElementsByName('list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            if(checkboxes[i].checked == true){
                list[ctr++]=checkboxes[i].value;
            }
        }
        if(ctr==0){
          list[0]=document.getElementById("deleteIndividual").value;
        }
        $.ajax({
            type: 'post',
            url: '../php/emailTemplates/deleteTemplate.php',
            data:{
              list:list,
            },
            success:function(response){
              if(response == 'Deleted'){
                  toastr.success("Template Deleted");
                  $.ajax({
                    type:'post',
                    url:'../php/display/templates.php',
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
                  document.getElementById("selectAll").checked=false;
              }else{
                toastr.error(response);
              }
            }
          });
          return false;
      }
      function info(id){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("templateInfo").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../php/emailTemplates/printEmailTemplateInfo.php?id="+id,true);
        xmlhttp.send();
    }
      function confirmDel(){
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
        }
          if(confirm("are you sure you want to delete this template/s?")){
            document.getElementById("delTemp").click();
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
        xmlhttp.open("GET","../php/emailTemplates/searchTemplates.php?name="+name+"&type="+type,true);
        xmlhttp.send();
    }
    document.addEventListener('DOMContentLoaded', function() {
    autosize(document.querySelectorAll('#notes'));
}, false);
    
    </script>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.MODAL -->
  <div class="modal fade bd-example-modal-lg" id="addemailTemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-file" aria-hidden="true"></i> Add Email Template</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
        <div class="alert alert-info" role="alert">
            <b>Info:</b><br>
            <p style="text-align:justify;margin:0">
              Email greetings and footer attachments are automatically added.  
            </p> 
          </div>
          <div id="forCopy1"></div>
          <form action="" method="post" id="addTemplateModal" onsubmit="return addTemplate();">
          <div class="form-group">
              <label for="exampleFormControlInput1">Template Name</label><a href="#" class="text-secondary" onclick="copyToClip1()"  style="margin-left:60%;"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy Link for Booking</a>
              <input type="text" class="form-control" id="TemplateName" placeholder="Template Name" required>
          </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Subject</label>
                  <input type="text" class="form-control" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                  <label for="exampleFormControlTextarea1">Message</label>
                  <textarea id="message" required></textarea>
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Template</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="templateInfo">
          
        
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="editTemp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Email Template</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
        <div class="alert alert-info" role="alert">
            <b>Info:</b><br>
            <p style="text-align:justify;margin:0">
              Email greetings and footer attachments are automatically added.  
            </p> 
          </div>
        <form action="" method="post" onsubmit="return updateEmailTemplate();">
        <div id="forCopy">
        </div>
          <div id="editTempBody">
            <input type="text" id="tempID" style="display:none">
          <div class="form-group">
              <label for="exampleFormControlInput1">Template Name</label><a href="#" class="text-secondary" onclick="copyToClip()"  style="margin-left:60%;"><i class="fa fa-clipboard" aria-hidden="true"></i> Copy Link for Booking</a>
              <input type="text" class="form-control" id="etname" name="etname" required>
              
          </div>
          <div class="form-group">
              <label for="exampleFormControlInput1">Subject</label>
              <input type="text" class="form-control" id="esub" name="esub" required>
          </div>
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Message Body</label>
              <textarea id="emes" required></textarea>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Template</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- /.content -->
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="row">
      <strong>MAUI SNORKELING LANI KAI &copy; 2020.</strong>
      All rights reserved.
      <a href="./PrivacyPolicy" target="_blank" class="text-secondary" style="margin-left:45%;border:none;padding:0;">Privacy Policy</a>
      <a href="./TermsAndConditions" target="_blank" class="text-secondary" style="margin-left:2%;border:none;padding:0;">Terms of Use</a>
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
    function updateEmailTemplate(){
        var  id = document.getElementById("tempID").value;
        var  tname = document.getElementById("etname").value;
        var  sub = document.getElementById("esub").value;
        var  mes = $('#emes').summernote('code');
        $.ajax({
            type: 'post',
            url: '../php/emailTemplates/updateEmailTemplate.php',
            data:{
              tempid:id,
              tname:tname,
              sub:sub,
              mes:mes,
            },
            success:function(response){
              if(response == 'Updated'){
                  toastr.success("Template Updated");
                  $.ajax({
                  type:'post',
                    url:'../php/display/templates.php',
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
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- TOASTR -->
<script src="../plugins/toastr/toastr.min.js"></script>
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
  $('#message').summernote({
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
  $('#emes').summernote({
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
</script>
</body>
</html>
