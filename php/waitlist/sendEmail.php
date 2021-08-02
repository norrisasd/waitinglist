<?php
    require '../functions.php';
    require '../../phpmailer/PHPMailerAutoload.php';
    $waitIndId = $_POST['waitIndId'];
    $subject=$_POST['subject'];
    $Bodymessage=$_POST['message'];
    $attachment="\n<b style='color:black'>Maui Snorkeling Lani Kai</b>
                mauisnorkeling.com
                <span style='color:black'>888.983.8080</span>
                <span style='color:black'>395 Maalaea Rd Slip 76, Wailuku, HI 96793, United States</span>
                <img src='cid:logo_image'>
                ";
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
                $name = getListById($db,$id);
                $forUrl=base64_encode($name['client_id']);
                $forUrl=urlencode($forUrl);
                // $links  = "If you don't want to receive these emails from Maui Snorkeling Lani Kai in the future, you can <a href='https://waitlist.mauisnorkeling.com/php/unsubscribe.php?id=".$forUrl."'>Unsubscribe</a>.";
                $links  = "If you don't want to receive these emails from Maui Snorkeling Lani Kai in the future, you can <a href='#'>Unsubscribe</a>.";
                $message = '<span style="color:black;font-size :18px;">Aloha <b>'.$name['name'].','."</b></span>\n";
                $message .=$Bodymessage;
                $message .=$attachment;
                $message .= $links;
                $email =getEmailById($db,$id);
                $retval=sendEmail($email,$subject,$message,$cred);
                $ai = getAutoIncrementNotification($db);
                
                if(!$retval){
                    break;
                }
                else{
                    if($_SESSION['access']==0){
                        $_SESSION['emailSent'].="\t\t".$email."\r\n";
                    }
                    createEmailNotification($db,$subject,$email,$tempname);
                    createWaitlistNotification($db,$id,$ai);
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
            $name = getListById($db,$waitIndId);
            $forUrl=base64_encode($name['client_id']);
            $forUrl=urlencode($forUrl);
            // $links  = "If you don't want to receive these emails from Maui Snorkeling Lani Kai in the future, you can <a href='https://waitlist.mauisnorkeling.com/php/unsubscribe.php?id=".$forUrl."'>Unsubscribe</a>.";
            $links  = "If you don't want to receive these emails from Maui Snorkeling Lani Kai in the future, you can <a href='#'>Unsubscribe</a>.";
            $message = '<span style="color:black;font-size: 18px;">Aloha <b>'.$name['name'].','."</b></span>\n";
            $message .=$Bodymessage;
            $message .=$attachment;
            $message .=$links;
            $email =getEmailById($db,$waitIndId);
            $retval=sendEmail($email,$subject,$message, $cred);
            $ai = getAutoIncrementNotification($db);
            if(!$retval){
            }   
            else{
                if($_SESSION['access']==0){
                    $_SESSION['emailSent'].="\t\t".$email."\r\n";
                }
                createEmailNotification($db,$subject,$email,$tempname);
                createWaitlistNotification($db,$waitIndId,$ai);
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
        echo $cred->getSender();
    }
?>