<?php
// DB CONNECTION
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
    // BUSINESS LOGO/NAME
    $businessName='Maui Snorkeling<br> Lani Kai';
    //for logo ./dist/img/TURTLE.png
    //home page --- index.php


    //passing dbname
    $_SESSION['db']=$data;


    // AWS
    // $_SESSION['sender']='info@mauisnorkeling.com';
    // $_SESSION['smtpUser']='AKIA3LKCDTEVT3SEYNXJ';
    // $_SESSION['smtpPass']='BCavRNQT3htkExIQ8tV24z6in/4Lu/zTTLQ30OEr90aC';
    // $_SESSION['smtpHost']='email-smtp.us-east-2.amazonaws.com';
    // $_SESSION['smtpPort']=587;
    //GMAIL
    $_SESSION['sender']='info.mauisnorkeling@gmail.com';
    $_SESSION['smtpUser']='info.mauisnorkeling@gmail.com';
    $_SESSION['smtpPass']='Mauisnorkeling21';
    $_SESSION['smtpHost']='smtp.gmail.com';
    $_SESSION['smtpPort']=587;

    
?>
