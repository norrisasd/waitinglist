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
//siteground
//     $host="localhost";
//     $user="uarg4jgrrxrfe";
//     $pass="e#3$2316@fF[";
//     $data="dbwdgw3oahbswe";
    $db = mysqli_connect($host,$user,$pass,$data);
        //local
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
