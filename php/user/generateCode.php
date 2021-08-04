<?php
    require "../functions.php";
    require '../../phpmailer/PHPMailerAutoload.php';
    $randomNumber = rand(100000,999999);
    $name=$_GET['username'];
    $email=$_GET['email'];
    $message = 'Aloha <b>'.$name.','."</b>\n\n";
    $message="You are trying to reset your password.\n
            Your email verification code is ".$randomNumber."

            <b style='color:black'>Maui Snorkeling Lani Kai</b>
                mauisnorkeling.com
                <span style='color:black'>888.983.8080</span>
                <span style='color:black'>395 Maalaea Rd Slip 76, Wailuku, HI 96793, United States</span>
                <img src='cid:logo_image'>\n
                ";
    $retval=sendEmail($email,"Email Verification Code",$message,$cred);
    // $retval=true;
    if($retval){
        $response="sent";
    }else{
        $response="not sent";
    }
    $arr = array('verCode'=>$randomNumber,'res'=>$response);
    echo json_encode($arr);
?>