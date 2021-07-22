<?php
//connection
    require '../php/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>User Form</title>
<link rel="icon" href="../dist/img/TURTLE.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
</style>
</head>
<script>
    function addUser(){
        var username=document.getElementById('username').value;
        var password=document.getElementById('password').value;
        var cpassword=document.getElementById('cpassword').value;
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
            email:email
          },
          success:function(response){
            if(response == 'Success'){
              toastr.success(response);
              docuemnt.getElementById("myForm").reset();
            }else{
              toastr.error(response);
            }
            
          }
        });
        return false;
      }
      function validate(val) {
        v1 = document.getElementById("username");
        v2 = document.getElementById("email");
        v3 = document.getElementById("password");
        v4 = document.getElementById("cpassword");
        

        flag1 = true;
        flag2 = true;
        flag3 = true;
        flag4 = true;

        if(val>=1 || val==0) {
            if(v1.value == "") {
                v1.style.borderColor = "red";
                flag1 = false;
            }
            else {
                v1.style.borderColor = "green";
                flag1 = true;
            }
        }

        if(val>=2 || val==0) {
            if(v2.value == "") {
                v2.style.borderColor = "red";
                flag2 = false;
            }
            else {
                v2.style.borderColor = "green";
                flag2 = true;
            }
        }
        if(val>=3 || val==0) {
            if(v3.value == "") {
                v3.style.borderColor = "red";
                flag3 = false;
            }
            else {
                v3.style.borderColor = "green";
                flag3 = true;
            }
        }
        if(val>=4 || val==0) {
            if(v4.value == "") {
                v4.style.borderColor = "red";
                flag4 = false;
            }
            else {
                v4.style.borderColor = "green";
                flag4 = true;
            }
        }

        flag = flag1 && flag2 && flag3 && flag4;

        return flag;
    }
</script>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" method="post" action="" onsubmit="return addUser();" id="myForm" autocomplete="off">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw" style="padding-bottom:25px" aria-hidden="true"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="username" class="form-control" onblur="validate(1)" required/>
                      <label class="form-label" for="form3Example1c">Your Username</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw" style="padding-bottom:25px"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="email" class="form-control" onblur="validate(2)" required />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw" style="padding-bottom:25px"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="password" class="form-control" onblur="validate(3)" required />
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw" style="padding-bottom:25px"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="cpassword" class="form-control" onblur="validate(4)" required />
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input
                      class="form-check-input me-2"
                      type="checkbox"
                      value=""
                      id="form2Example3c"
                      required
                    />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="../pages/TermsAndConditions.php">Terms and Conditions</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="../dist/img/logo-dark.png" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
</html>