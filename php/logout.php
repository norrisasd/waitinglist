<?php
    require_once 'functions.php';
    require '../phpmailer/PHPMailerAutoload.php';
    // $email="info.mauisnorkeling@gmail.com";
    // $subject="Updates During Session";
    // $message="<b><h3>The following people that are in the waitlist has been sent an Email:</h3></b>"."\r\n";
    // $message.="\t\t"."<b>ID"."\t\t"."NAME"."\t\t"."PHONE"."\t\t"."EMAIL</b>"."\r\n";
    // if($_SESSION['access'] == 0){
    //     if($_SESSION['approvalSent'] == '' && $_SESSION['emailSent'] == '' && $_SESSION['clientDeleted'] == '' && $_SESSION['dndUpdated'] == '' ){
            
    //     }else{
    //         $message.=$_SESSION['approvalSent']."\r\n";
    //         $message.="<b><h3>Sent an email :</h3></b>"."\r\n";
    //         $message.="\t\t"."<b>EMAIL</b>"."\r\n";
    //         $message.=$_SESSION['emailSent']."\r\n";
    //         $message.="<b><h3>Clients that has been deleted :</h3></b>"."\r\n";
    //         $message.="\t\t"."<b>ID"."\t\t"."NAME"."\t\t"."PHONE"."\t\t"."EMAIL</b>"."\r\n";
    //         $message.=$_SESSION['clientDeleted']."\r\n";
    //         $message.="<b><h3>Updated DND:</h3></b>"."\r\n";
    //         $message.="\t\t"."<b>ID"."\t\t"."NAME"."\t\t"."PHONE"."\t\t"."EMAIL</b>"."\r\n";
    //         $message.=$_SESSION['dndUpdated']."\r\n";
    //         sendEmail($email,$subject,$message,$cred);
    //     }
        
    // }
    
    session_unset();
    session_destroy();  
    echo "<script>window.location.href='../loginPage'</script>";
?>