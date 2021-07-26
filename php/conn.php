<?php
//ALL CONNECTION STRINGS ARE IN Config.JSON
// DB CONNECTION
    $cred = file_get_contents(__DIR__."/Config.json");
    $cred = json_decode($cred);
    $host=$cred->dbHost;
    $user=$cred->dbUser;
    $pass=$cred->dbPass;
    $data=$cred->dbData;
    require 'cred.php';
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

    
    $sender =$cred->smtpSender;
    $smtpUser =$cred->smtpUser;
    $smtpPass=$cred->smtpPass;
    $smtpHost=$cred->smtpHost;
    $smtpPort=$cred->smtpPort;
    $smtpSES = new SMTPcred($smtpHost,$smtpUser,$smtpPass,$sender,$smtpPort);
    
?>
