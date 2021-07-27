<?php
    require '../functions.php';
    require '../../phpmailer/PHPMailerAutoload.php';
    $waitIndId = $_POST['waitIndId'];
    $subject=$_POST['subject'];
    $Bodymessage=$_POST['message'];
    $attachment="\n\n<b style='font-size:16px'><a href='https://mauisnorkeling.tripworks.com/widgets/tripBuilder?showDetail=1&defaultView=gallery&language=en&m=%7B%22landingUrl%22%3A%22https%3A%2F%2Fmauisnorkeling.com%2F%22%2C%22referrerUrl%22%3A%22%22%2C%22firstView%22%3A%222021-07-02T14%3A50%3A33.308Z%22%2C%22pageViews%22%3A23%2C%22recents%22%3A%5B%22https%3A%2F%2Fmauisnorkeling.com%2F%22%2C%22https%3A%2F%2Fmauisnorkeling.com%2F%22%2C%22https%3A%2F%2Fmauisnorkeling.com%2F%22%2C%22https%3A%2F%2Fmauisnorkeling.com%2F%22%2C%22https%3A%2F%2Fmauisnorkeling.com%2F%22%5D%2C%22language%22%3A%22en-US%22%2C%22viewport%22%3A%7B%22height%22%3A763%2C%22width%22%3A1519%7D%7D&inModal=true'>Book Now</a></b>
                <b style='color:black'>Maui Snorkeling Lani Kai</b>
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
                // $links  = "<a href='https://waitlist.mauisnorkeling.com/php/unsubscribe.php?id=".$forUrl."'>Unsubscribe</a>";
                $links  = "<a href='#'>Unsubscribe</a>";
                $message = 'Aloha <b>'.$name['name'].','."</b>\n\n";
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
            // $links  = "<a href='https://waitlist.mauisnorkeling.com/php/unsubscribe.php?id=".$forUrl."'>Unsubscribe</a>";
            $links  = "<a href='#'>Unsubscribe</a>";
            $message = 'Aloha <b>'.$name['name'].','."</b>\n\n";
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