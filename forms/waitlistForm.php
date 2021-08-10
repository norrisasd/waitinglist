<?php
//connection
    require '../php/functions.php';
    $cred = file_get_contents("../php/Config.json");
    $cred = json_decode($cred);
?>
<!DOCTYPE html>
<html>
<head>
<title>Waitinglist Form</title>
    <link rel="icon" href="../dist/img/TURTLE.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color:#f2f3f4;
    background-repeat: no-repeat;
    background-size: 100% 100%
    }
    
    .card {
        padding: 30px 40px;
        margin-top: 30px;
        margin-bottom: 60px;
        border: none !important;
        opacity:100%;
        box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
    }

    .blue-text {
        color: black
    }

    .form-control-label {
        margin-bottom: 0
    }

    input,
    textarea,
    select,
    button {
        padding: 8px 15px;
        border-radius: 5px !important;
        margin: 5px 0px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        font-size: 18px !important;
        font-weight: 300
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #00BCD4;
        outline-width: 0;
        font-weight: 400
    }

    .btn-block {
        text-transform: uppercase;
        font-size: 15px !important;
        font-weight: 400;
        height: 43px;
        cursor: pointer
    }

    .btn-block:hover {
        color: #fff !important
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }
</style>
</head>
<script>
    function addListInfo(){
        var name=document.getElementById('name').value;
        var phone=document.getElementById('phone').value;
        var email=document.getElementById('email').value;
        var sdate=document.getElementById('sdate').value;
        var edate=document.getElementById('edate').value;
        var passengers=document.getElementById('passengers').value;
        var aname=document.getElementById('aname').value;
        var notes=document.getElementById('notes').value;
        document.getElementById("submitBtn").disabled=true;
        toastr.info("We are processing your request. Please wait!");
        $.ajax({
          type: 'post',
          url: '../php/waitlist/addList.php',
          data:{
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
                toastr.success("Success! You are now added in the Waitlist!");
                document.getElementById("myForm").reset();
                grecaptcha.reset();
                window.location.href="../pages/confirmation/WaitlistConfirmation.php";
            }  
            else{
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
        v2 = document.getElementById("passengers");
        v3 = document.getElementById("email");
        v4 = document.getElementById("phone");
        v5 = document.getElementById("sdate");
        v6 = document.getElementById("edate");
        v7 = document.getElementById("aname");
        

        flag1 = true;
        flag2 = true;
        flag3 = true;
        flag4 = true;
        flag5 = true;
        flag6 = true;
        flag7 = true;

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
        if(val>=5 || val==0) {
            if(v5.value == "") {
                v5.style.borderColor = "red";
                flag5 = false;
            }
            else {
                v5.style.borderColor = "green";
                flag5 = true;
            }
        }
        if(val>=6 || val==0) {
            if(v6.value == "") {
                v6.style.borderColor = "red";
                flag6 = false;
            }
            else {
                v6.style.borderColor = "green";
                flag6 = true;
            }
        }
        if(val>=7 || val==0) {
            if(v7.value == "") {
                v7.style.borderColor = "red";
                flag7 = false;
            }
            else {
                v7.style.borderColor = "green";
                flag7 = true;
            }
        }

        flag = flag1 && flag2 && flag3 && flag4 && flag5 && flag6 && flag7;

        return flag;
    }
</script>
<body>
<div class="container" style="margin:0;padding:0">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-9 col-11 text-center form login-form">
        <img src="../dist/img/logo-dark.png" style="height:auto;max-width:400px;padding:10px" class="img-thumbmail" alt="User Image">
            <h3>Maui Snorkeling Lani Kai</h3>
            <p class="blue-text">Was the activity you're looking for not available? <br> Fill out this waitlist and get notified when there is availability!</p>
                <form method="post"  action="" onsubmit="return addListInfo();" id="myForm" autocomplete="off">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Full Name<span class="text-danger"> *</span></label> 
                            <input type="text" name="name" id="name" autocomplete="off" placeholder="Enter your Full Name"  autocomplete="off" onblur="validate(1)" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Number of Passengers<span class="text-danger"> *</span></label> 
                            <input type="number" id="passengers" name="passengers" autocomplete="off" placeholder="0" onblur="validate(2)" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label> 
                            <input type="email" id="email" name="email" autocomplete="off" placeholder="youremail@email.com" onblur="validate(3)" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> 
                            <input type="number" id="phone" name="phone" autocomplete="off" placeholder="Phone Number" onblur="validate(4)" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">First Date Available<span class="text-danger"> *</span></label> 
                            <input type="date" id="sdate" name="sdate" autocomplete="off" placeholder="" onblur="validate(5)" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Last Date Available<span class="text-danger"> *</span></label> 
                            <input type="date" id="edate" name="edate" autocomplete="off" placeholder="" onblur="validate(6)" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Activity Name<span class="text-danger"> *</span></label> 
                            <select name="aname" id="aname" onblur="validate(7)" required>
                                <option value="" selected hidden>Choose Activity</option>
                                <?php getAllActivity($db);?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Notes</label> 
                            <textarea class="form-control" style="height:45px" name="notes" id="notes" autocomplete="off" placeholder="Additional Notes" ></textarea>
                        </div>
                    </div>      
                    <br>
                    <div class="row justify-content-center"> 
                        <div class="form-group col-sm-6"> 
                            <div style="display:flex">
                                <input class="form-check-input" type="checkbox" value="" style="margin:0;" required>
                                <p style="font-size:12px;margin-left:auto" >
                                By checking this box, I agree that the Mauisnorkeling will contact me through my email or phone number regarding this matter. Also, I agree all statements in <a href="../pages/TermsAndConditions.php">Terms and Conditions</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="text-align:center">
                        <div class="g-recaptcha" style="display:inline-block" data-sitekey="<?php echo $cred->recaptchaSiteKey;?>" data-callback="verify_captcha"></div>
                    </div>
                    <div class="row justify-content-center" style="margin-top:1%">
                        <div class="form-group col-sm-6"> 
                            <button type="submit" class="form-control btn btn-dark" id="submitBtn" disabled>SUBMIT</button> 
                        </div>
                    </div>
                </form>
                
        </div>
    </div>
</div>
</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script>
    
</script>
</html>