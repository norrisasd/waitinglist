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
<?php
//connection
    
    require './php/conn.php';
?>
<body>
<center><h1>Waitinglist Form</h1></center>
    <div class="col-sm-8" style="margin:1rem auto">
        <form action="./php/addList.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Phone</label>
                <input type="number" class="form-control" name="phone" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Start Date</label>
                <input type="date" class="form-control" name="sdate" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">End Date</label>
                <input type="date" class="form-control" name="edate" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Number of Passengers</label>
                <input type="number" class="form-control" name="passengers" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Activity Name</label>
                <select name="aname" required>
                    <option selected disabled>Select</option>
                    <option value="MORNING SNORKELING TOURS">MORNING SNORKELING TOURS</option>
                    <option value="AFTERNOON SNORKELING TOURS">AFTERNOON SNORKELING TOURS</option>
                    <option value="GROUPS & PRIVATE CHARTERS">GROUPS & PRIVATE CHARTERS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Additional Notes</label>
                <textarea class="form-control" name="notes" required></textarea>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary" name="submit">Submit Form</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</html>