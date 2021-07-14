<?php
    $host="localhost";
    $user="root";
    $pass="";
    $data="waitlist";
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
    session_start();
    $_SESSION['db']=$data;
    
?>
