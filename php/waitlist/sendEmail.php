<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../functions.php';
    require '../../phpmailer/PHPMailerAutoload.php';
    $waitIndId = $_POST['waitIndId'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    $tempname=$_POST['tempName'];
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
                    setEmailSentRecord($db,$id,$tempname);
                    updateStatus($db,$id);
                }
            }
        }
    }else if($waitIndId != ''){
        $dnd = getClientDNDByWaitId($db,$waitIndId);
        $email =getEmailById($db,$waitIndId);
        if($dnd == 1){
            $flag = true;
            $str.=$email."\n";
        }
        if($flag == true){
            echo $str."\nSelected row must not be on DND list";
            return;
        }else{
            $email =getEmailById($db,$waitIndId);
            $retval=sendEmail($email,$subject,$message);
            if(!$retval){
            }
            else{
                if($_SESSION['access']==0){
                    $_SESSION['emailSent'].="\t\t".$email."\r\n";
                }
                setEmailSentRecord($db,$waitIndId,$tempname);
                updateStatus($db,$waitIndId);
            }
        }
    }else{
        echo 'No one to send!';
        return;
    }
    if($retval){
        echo 'Email Sent';
    }else{
        echo mysqli_error($db);
    }
?>