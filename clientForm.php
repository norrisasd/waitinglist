<?php
//connection
    require './php/conn.php';
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
<center><h1>Client Form</h1></center>
    <div class="col-sm-8" style="margin:1rem auto">
        <form action="./php/addClient.php" method="post" autocomplete="off">
            <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Phone</label>
                <input type="number" class="form-control" name="phone" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="off" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit">Submit Form</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</html>