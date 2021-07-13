<?php
    require '../functions.php';
    require '../../phpmailer/PHPMailerAutoload.php';
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    $retval = false;
    $flag = false;
    $str ="The following emails are on DND:"."\n";
    if(!empty($_POST['list'])){
        foreach($_POST['list'] as $id){
            $dnd = getClientDNDByWaitId($db,$id);
            $email =getEmailById($db,$id);
            if($dnd == 1){
                $flag = true;
                $str.=$email."\n";
            }
        }
        if($flag == true){
            echo $str."\nSelected row must not be on DND list";
            return;
        }else{
            foreach($_POST['list'] as $id){
                $email =getEmailById($db,$id);
                $retval=sendEmail($email,$subject,$message);
                if(!$retval){
                    break;
                }
                else{
                    if($_SESSION['access']==0){
                        $_SESSION['emailSent'].="\t\t".$email."\r\n";
                    }
                    updateStatus($db,$id);
                }
            }
        }
    }
    if($retval){
        echo 'Email Sent';
    }else{
        echo mysqli_error($db);
    }
?>