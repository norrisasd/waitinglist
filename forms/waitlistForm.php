<?php
//connection
    require '../php/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Waitinglist Form</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    body {
    color: #000;
    overflow: hidden;
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
            alert(response);
            if(response == 'Success')
            location.reload();
          }
        });
        return false;
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
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Waitinglist Form</h3>
            <p class="blue-text">Just answer a few questions<br> so that we can personalize the right experience for you.</p>
            <div class="card">
                <h5 class="text-center mb-4">MAUISNORKELING </h5>
                <form method="post" action="" onsubmit="return addListInfo();" id="myForm" autocomplete="off">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Full Name<span class="text-danger"> *</span></label> 
                            <input type="text" name="name" id="name" placeholder="Enter your Full Name"  autocomplete="off" onblur="validate(1)" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Number of Passengers<span class="text-danger"> *</span></label> 
                            <input type="number" id="passengers" name="passengers" placeholder="0" onblur="validate(2)" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label> 
                            <input type="email" id="email" name="email" placeholder="youremail@email.com" onblur="validate(3)" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> 
                            <input type="text" id="phone" name="phone" placeholder="Phone Number" onblur="validate(4)" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Start Date<span class="text-danger"> *</span></label> 
                            <input type="date" id="sdate" name="sdate" placeholder="" onblur="validate(5)" required> 
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">End Date<span class="text-danger"> *</span></label> 
                            <input type="date" id="edate" name="edate" placeholder="" onblur="validate(6)" required> 
                        </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Activity Name<span class="text-danger"> *</span></label> 
                            <select name="aname" id="aname" onblur="validate(7)" required>
                                <option value="" selected hidden>Select</option>
                                <?php getAllActivity($db);?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> 
                            <label class="form-control-label px-3">Notes</label> 
                            <textarea class="form-control" name="notes" id="notes" autocomplete="off" placeholder="Additional Notes" ></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">SUBMIT</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</html>