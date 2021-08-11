<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maui Snorkeling</title>
    <link rel="icon" href="./dist/img/TURTLE.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <!-- jquery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form accept-charset="UTF-8" class="form-signin" role="form" action="" method="post" onsubmit="return setLogin();">
                <img src="./php/logo-small.png" style="width:100%;max-width:100%;height: auto;margin: 0 auto" >
                    <p class="text-center">Login with your username and password.</p>
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Username" id="username" type="text">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-label-group">
                        <input class="form-control" placeholder="Password" id="password" type="password" value="">
                        <label for="password">Password</label>
                    </div>
                    <div class="link forget-pass text-right">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                        </label>
                    </div>
                    <div class="link forget-pass text-left"><a href="#" data-toggle="modal" data-target="#emailSending">Forgot password?</a></div>
                    
                    <div class="form-group">
                        <input class="form-control btn btn-dark" type="submit" value="Login" name="login">
                    </div>
                    <!-- <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Signup now</a></div> -->
                </form>
            </div>
        </div>
        <div class="text-center" style="margin-top:2%">
            <span>MAUI SNORKELING LANI KAI &copy; 2020. All rights reserved.</span>
            <br>
            <span>
                <a href="./pages/PrivacyPolicy.php" target="_blank" class="text-secondary" style="margin:1%;text-decoration:none">Privacy Policy</a>
                <a href="./pages/TermsAndCondition.php" target="_blank" class="text-secondary" style="margin:1%;text-decoration:none">Terms of Use</a>
            </span>
        </div>
    </div>
    <!-- <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-sm-8" style="border:1px solid;padding:5%;margin:auto">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please sign in</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" action="" method="post" onsubmit="return setLogin();">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" id="username" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" id="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                    
                                </label>
                                <a href="#" style="margin:0 0 0 28%" data-toggle="modal" data-target="#emailSending">Forgot Password?</a>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="login">
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        
    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg"  id="termsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">USER AGREEMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="./pages/TermsAndConditions.php" id="agreement" title="Terms And Conditions" style="height:500px;width:100%"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="acceptBtn" onclick="updateStatus()">I Accept</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="emailSending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <h3>EMAIL VERIFICATION</h3>
                <form id="emailVerificationForm">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="verUsername" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                    <button type="button" class="btn btn-outline-primary" id="vfBtn" onclick="verifyEmail()" style="margin:1%">Check</button>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Verification Code (6 digits)</label>
                    <input type="number" class="form-control" id="code" placeholder="123456" min="100000" max="999999">
                    <button type="button" class="btn btn-outline-primary" id="cdBtn" onclick="generateCode()" style="margin:1%" disabled>Send Code</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBtn" value="" onclick="verify()">Verify</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                CHANGE PASS
                <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="password" class="form-control" id="changePassw" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confrim Password</label>
                    <input type="password" class="form-control" id="confirmChangePass" placeholder="Enter Username">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="changeBtn" onclick="changePass()">Change Password</button>
            </div>
            </div>
        </div>
    </div>


</body>
<script src="plugins/toastr/toastr.min.js"></script>
<script>
    function verifyEmail(){
        var email = document.getElementById("email").value;
        var username = document.getElementById("verUsername").value;
        $.ajax({
            type:'get',
            url:'./php/user/verifyEmail.php',
            data:{
                email:email,
                username:username
            },
            success:function(response){ 
              if(response == 'exist'){
                toastr.success('User and Email Exist');
                document.getElementById("cdBtn").disabled=false;
                document.getElementById("changeBtn").value=username;
              }else{
                toastr.error(response);
              }
            }
          });
          return false;
    }
    function generateCode(){
        document.getElementById("cdBtn").disabled=true;
        var email = document.getElementById("email").value;
        var username = document.getElementById("verUsername").value;
        myTimer = setInterval(myClock, 1000);
        var c = 120;
        $.ajax({
            type:'get',
            url:'./php/user/generateCode.php',
            data:{
                email:email,
                username:username
            },
            success:function(response){ 
                var arrJ=JSON.parse(response);
              if(arrJ.res == 'sent'){
                toastr.success('Email Verification Code Sent!');
                document.getElementById("submitBtn").value=arrJ.verCode;
                toastr.info(arrJ.verCode);
              }else{
                toastr.error(response);
              }
            }
          });
          return false;
        function myClock() {
            document.getElementById("cdBtn").innerHTML = --c +" Seconds";
            if (c == 0) {
                clearInterval(myTimer);
                document.getElementById("cdBtn").innerHTML ="Generate Code";
                document.getElementById("cdBtn").disabled=false;
            }
        }
   }
    function verify(){
        var code = document.getElementById("submitBtn").value;
        var icode = document.getElementById("code").value;
        if(code == icode){
            toastr.info("Please Change your password!");
            document.getElementById("emailVerificationForm").reset();
            document.getElementById("cdBtn").innerHTML ="Generate Code";
            document.getElementById("cdBtn").disabled=true;
            $("#emailSending").modal('hide');
            $("#changePass").modal('show');
        }else{
            toastr.info("not same");
        }
        
    }
    function updateStatus(){
        $.ajax({
            type: 'post',
            url: './php/user/updateFirstAccess.php',
            success:function(response){
              if(response == ''){
                  window.location.href="index.php";
              }else{
                  toastr.error(response);
              }
            }
          });
          return false;
    }
    function changePass(){
        var pass = document.getElementById("changePassw").value;
        var cpass = document.getElementById("confirmChangePass").value;
        var username = document.getElementById("changeBtn").value;
        toastr.info(username);
        if(pass!=cpass){
            toastr.error("Password not the same");
            return;
        }
        $.ajax({
            type: 'post',
            url: './php/user/updatePassword.php',
            data:{
                pass:pass,
                username:username
            },
            success:function(response){
              if(response == 'Updated'){
                  toastr.success("Password Updated");
                  $('.modal').modal("hide");
              }else{
                  toastr.error(response);
              }
            }
          });
          return false;
    }
    function setLogin(){
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
          $.ajax({
            type: 'post',
            url: './php/login.php',
            data:{
              username:username,
              password:password,
            },
            success:function(response){
              
              if(response == ''){
                  window.location.href="index.php";
              }else if(response == 'first'){
                $("#termsModal").modal('show');
              }else{
                  toastr.error(response);
              }
            }
          });
          return false;
    }
  toastr.options.progressBar = true;
  toastr.options.preventDuplicates = true;
  toastr.options.closeButton = true;
</script>


</html>