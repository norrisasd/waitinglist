<?php
    require '../functions.php';
    require '../../phpmailer/PHPMailerAutoload.php';
    $qdate="SELECT CURDATE() as curdate;";
    $rdate=mysqli_query($db,$qdate);
    $curdate =mysqli_fetch_assoc($rdate);// currentdate
    
    $dbName=$_SESSION['db'];
    $qAI="SELECT `AUTO_INCREMENT`as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = 'waitlist';";
    $rAI=mysqli_query($db,$qAI);
    $ai=mysqli_fetch_assoc($rAI);
    $ai=$ai['AI'];  //Auto Increment of waitlist

    $cAI="SELECT `AUTO_INCREMENT`as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = 'clients';";
    $cAI=mysqli_query($db,$cAI);
    $cAI=mysqli_fetch_assoc($cAI);
    $cAI=$cAI['AI'];//notification Auto Increment

        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        list($trash,$domain) = explode('@',$email);
        if(!checkdnsrr($domain,'MX')){
            echo 'Email is not Valid!';
            return;
        }
        // if($edate<$sdate || $sdate<$curdate['curdate']){
        //     echo 'Date Error';
        //     return;
        // }
        //SEND EMAIL
        $message = 'Aloha <b>'.$name.','."</b>\n\n";
        $message="Thank you for booking in our waitlist.\n
            Maui Snorkeling, formerly Friendly Charters, has been in business since 1995. Over that time, close to 1 million passengers have experienced what Maui Snorkeling is all about.
            We are a small, family-owned business and our mission is to allow everyone to enjoy the beautiful people and places of Maui and Hawai'i.
            \n\n
            <b style='color:black'>Maui Snorkeling Lani Kai</b>
                mauisnorkeling.com
                <span style='color:black'>888.983.8080</span>
                <span style='color:black'>395 Maalaea Rd Slip 76, Wailuku, HI 96793, United States</span>
                <img src='cid:logo_image'>\n
                If you don't want to receive these emails from Maui Snorkeling Lani Kai in the future, you can <a href='#'>Unsubscribe</a>.
                ";
        $passengers=$_POST['passengers'];
        $aname=$_POST['aname'];
        $notes=$_POST['notes'];
        $query="INSERT INTO `waitlist`(`name`, `phone`, `email`, `waitlist_start_date`, `waitlist_end_date`, `waitlist_num_passengers`, `waitlist_activity_name`, `waitlist_notes`,`client_id`, `waitlist_date_created`, `waitlist_enabled`, `waitlist_approval_sent`) VALUES ('$name','$phone','$email','$sdate','$edate',$passengers,'$aname','$notes',$cAI,CURDATE(),1,0)";
        $result=mysqli_query($db,$query);

        if($result){
            $query="INSERT INTO `clients`( `client_name`, `client_phone`, `client_email`, `client_date_created`, `client_dnd`, `client_enabled`) VALUES ('$name','$phone','$email',CURDATE(),0,1)";
            $result = mysqli_query($db,$query);
            if($result){
                $query="INSERT INTO `notification_added`( `notification_type`, `notification_status`,`waitlist_id`) VALUES ('waitlist','0',$ai)";
                $result=mysqli_query($db,$query);
                $retval=sendEmail($email,"Registration Success",$message,$cred);
            }else{
                echo mysqli_error($db);
            }   
        }else{
            echo mysqli_error($db);
        }
        
        if($result){
            echo 'Success';
        }else{
            echo mysqli_error($db);
        }
?>