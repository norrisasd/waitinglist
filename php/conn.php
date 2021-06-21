<?php
    $host="localhost";
    $user="root";
    $pass="";
    $data="waitlist";
    $db = mysqli_connect($host,$user,$pass,$data);
        //local
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>