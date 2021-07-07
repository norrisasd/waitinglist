<?php
//connection
    require '../php/conn.php';
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
</style>
</head>
<body>
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
            $( '#myForm' ).each(function(){
                this.reset();
            });
          }
        });
        return false;
      }
</script>
<center><h1>Waitinglist Form</h1></center>
    <div class="col-sm-8" style="margin:1rem auto">
        <form method="post" action="" onsubmit="return addListInfo();" id="myForm" autocomplete="off">
            <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Phone</label>
                <input type="number" class="form-control" name="phone" id="phone" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Start Date</label>
                <input type="date" class="form-control" name="sdate" id="sdate" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">End Date</label>
                <input type="date" class="form-control" name="edate" id="edate" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Number of Passengers</label>
                <input type="number" class="form-control" name="passengers" id="passengers" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Activity Name</label>
                <select name="aname" id="aname" required>
                    <option value="MORNING SNORKELING TOURS">MORNING SNORKELING TOURS</option>
                    <option value="AFTERNOON SNORKELING TOURS">AFTERNOON SNORKELING TOURS</option>
                    <option value="GROUPS & PRIVATE CHARTERS">GROUPS & PRIVATE CHARTERS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Additional Notes</label>
                <textarea class="form-control" name="notes" id="notes" autocomplete="off" ></textarea>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">Submit Form</button>
        </form>
    </div>
</body>

<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</html>