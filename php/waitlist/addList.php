<?php
    require '../functions.php';
    $qdate="SELECT CURDATE() as curdate;";
    $rdate=mysqli_query($db,$qdate);
    $curdate =mysqli_fetch_assoc($rdate);// currentdate

    $qAI="SELECT `AUTO_INCREMENT`as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'waitlist' AND TABLE_NAME = 'waitlist';";
    $rAI=mysqli_query($db,$qAI);
    $ai=mysqli_fetch_assoc($rAI);
    $ai=$ai['AI'];  //Auto Increment of waitlist

    $nAI="SELECT `AUTO_INCREMENT`as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'waitlist' AND TABLE_NAME = 'notification';";
    $nAI=mysqli_query($db,$nAI);
    $nAI=mysqli_fetch_assoc($nAI);
    $nAI=$nAI['AI'];//notification Auto Increment

    $cAI="SELECT `AUTO_INCREMENT`as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'waitlist' AND TABLE_NAME = 'clients';";
    $cAI=mysqli_query($db,$cAI);
    $cAI=mysqli_fetch_assoc($cAI);
    $cAI=$cAI['AI'];//notification Auto Increment

        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        if($edate<$sdate || $sdate<$curdate['curdate']){
            echo 'Date Error';
            return;
        }
        $passengers=$_POST['passengers'];
        $aname=$_POST['aname'];
        $notes=$_POST['notes'];
        $query="INSERT INTO `waitlist`(`name`, `phone`, `email`, `waitlist_start_date`, `waitlist_end_date`, `waitlist_num_passengers`, `waitlist_activity_name`, `waitlist_notes`,`client_id`, `waitlist_date_created`, `waitlist_enabled`, `waitlist_approval_sent`) VALUES ('$name','$phone','$email','$sdate','$edate',$passengers,'$aname','$notes',$cAI,CURDATE(),0,0)";
        $result=mysqli_query($db,$query);

        if($result){
            $query="INSERT INTO `clients`( `client_name`, `client_phone`, `client_email`, `client_date_created`, `client_dnd`, `client_enabled`) VALUES ('$name','$phone','$email',CURDATE(),0,0)";
            $result = mysqli_query($db,$query);
            if($result){
                $query="INSERT INTO `notification`( `notification_subject`, `notification_email`, `notification_status`) VALUES ('waitlist','$email','0')";
                $result=mysqli_query($db,$query);
                if($result){
                    $query="INSERT INTO `waitlist_notfication`(`waitlist_id`, `notification_id`, `waitlist_notification_create_date`) VALUES ($ai,$nAI,CURDATE())";
                    $result = mysqli_query($db,$query);
                }else{
                    echo mysqli_error($db);
                }
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