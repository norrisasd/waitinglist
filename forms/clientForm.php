<?php
//connection
    require '../php/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Client Form</title>
<link rel="icon" href="../dist/img/TURTLE.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
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
    function addClient(){
        var name=document.getElementById('name').value;
        var phone=document.getElementById('phone').value;
        var email=document.getElementById('email').value;

        $.ajax({
          type: 'post',
          url: '../php/client/addClient.php',
          data:{
            name:name,
            phone:phone,
            email:email,
          },
          success:function(response){
            if(response == 'Success'){
                toastr.success(response);
                document.getElementById("clientForm").reset();
            }else{
                toastr.error(response);
            }
          }
        });
        return false;
      }
      function validate(val) {
        v1 = document.getElementById("name");
        v2 = document.getElementById("phone");
        v3 = document.getElementById("email");
        

        flag1 = true;
        flag2 = true;
        flag3 = true;

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

        flag = flag1 && flag2 && flag3;

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

                    <form class="mx-1 mx-md-4" method="post" action="" onsubmit="return addClient();" id="clientForm" autocomplete="off">

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw" style="padding-bottom:25px" aria-hidden="true"></i>
                        <div class="form-outline flex-fill mb-0">
                        <input type="text" id="name" class="form-control" onblur="validate(1)" required/>
                        <label class="form-label" for="form3Example1c">Name</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw" style="padding-bottom:25px" aria-hidden="true"></i>
                        <div class="form-outline flex-fill mb-0">
                        <input type="phone" id="phone" class="form-control" onblur="validate(2)" required/>
                        <label class="form-label" for="form3Example1c">Phone</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw" style="padding-bottom:25px"></i>
                        <div class="form-outline flex-fill mb-0">
                        <input type="email" id="email" class="form-control" onblur="validate(3)" required />
                        <label class="form-label" for="form3Example3c">Email</label>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
</html>