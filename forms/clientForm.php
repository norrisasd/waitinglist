<?php
//connection
    require '../php/functions.php';
    $cred = file_get_contents("../php/Config.json");
    $cred = json_decode($cred);
?>
<!DOCTYPE html>
<html>
<head>
<title>Client Form</title>
<link rel="icon" href="../dist/img/TURTLE.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="../css/style.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
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
                grecaptcha.reset();
                document.getElementById("submitBtn").disabled=true;
            }else{
                toastr.error(response);
            }
          }
        });
        return false;
      }
      function verify_captcha(){
        document.getElementById("submitBtn").disabled=false;
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 form login-form">
                <form class="form-signin" method="post" action="" onsubmit="return addClient();" id="clientForm" autocomplete="off">
                    <img src="../php/logo-small.png" style="width:100%;max-width:100%;height: auto;margin: 0 auto" >
                    <p class="text-center">Sign up now!</p>
                    <div class="form-label-group">
                        <i class="fas fa-user fa-lg me-3 fa-fw" style="padding-bottom:25px" aria-hidden="true"></i>
                        <input type="text" id="name" class="form-control" placeholder="Name" onblur="validate(1)" required/>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-label-group">
                        <input type="phone" id="phone" class="form-control" placeholder="Phone" onblur="validate(2)" required/>
                        <label for="phone">Phone</label>
                    </div>
                    <div class="form-label-group">
                        <input type="email" id="email" class="form-control" placeholder="Email" onblur="validate(3)" required />
                        <label for="email">Email</label>
                    </div>
                    <div class="link forget-pass text-center">
                        <label>
                            <input class="form-check-input me-2" type="checkbox" value="" required/> I agree all statements in<br> <a href="../pages/TermsAndConditions">Terms and Conditions</a>
                        </label>
                    </div>
                    <div class="text-center">
                        <div class="g-recaptcha" style="display:inline-block" data-sitekey="<?php echo $cred->recaptchaSiteKey;?>" data-callback="verify_captcha"></div>
                    </div>    
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-dark" id="submitBtn" disabled>Register</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row text-center" style="margin-top:2%">
            <span>MAUI SNORKELING LANI KAI &copy; 2020. All rights reserved.</span>
            <span>
                <a href="../pages/PrivacyPolicy" target="_blank" class="link-secondary" style="margin:1%;text-decoration:none">Privacy Policy</a>
                <a href="../pages/TermsAndConditions" target="_blank" class="link-secondary" style="margin:1%;text-decoration:none">Terms of Use</a>
            </span>
        </div>
    </div>
    

</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
</html>