<?php
    require '../functions.php';
    require '../../phpmailer/PHPMailerAutoload.php';
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    if(!empty($_POST['list'])){
        foreach($_POST['list'] as $list){
            $retval=sendEmail($list,$subject,$message);
            if(!$retval){
                break;
            }
            else{
                $_SESSION['emailSent'].="\t\t".$list."\r\n";
            }
        }
    }
    if($retval){
        echo 'Email Sent';
    }else{
        echo mysqli_error($db);
    }
?>