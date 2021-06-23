<?php
    $host="localhost";
    $user="root";
    $pass="";
    $data="waitlist";
//heroku
    // $host="remotemysql.com";
    // $user="GuUtM46wKG";
    // $pass="a6wDOZNQrQ";
    // $data="GuUtM46wKG";
    $db = mysqli_connect($host,$user,$pass,$data);
        //local
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
