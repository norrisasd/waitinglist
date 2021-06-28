<?php
    require 'conn.php';
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



    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        if($edate<$sdate || $sdate<$curdate['curdate']){
            echo '<script>alert("Date Error!")</script>;window.location="../form.php";';
            return;
        }
        $passengers=$_POST['passengers'];
        $aname=$_POST['aname'];
        $notes=$_POST['notes'];
        $query="INSERT INTO `waitlist`(`name`, `phone`, `email`, `waitlist_start_date`, `waitlist_end_date`, `waitlist_num_passengers`, `waitlist_activity_name`, `waitlist_notes`, `waitlist_date_created`, `waitlist_enabled`, `waitlist_approval_sent`) VALUES ('$name','$phone','$email','$sdate','$edate',$passengers,'$aname','$notes',CURDATE(),0,0)";
        $result=mysqli_query($db,$query);

        $query="INSERT INTO `notification`( `notification_subject`, `notification_email`, `notification_status`) VALUES ('waitlist','$email','0')";
        $result=mysqli_query($db,$query);

        $query="INSERT INTO `waitlist_notfication`(`waitlist_id`, `notification_id`, `waitlist_notification_create_date`) VALUES ($ai,$nAI,CURDATE())";
        $result = mysqli_query($db,$query);

        if($result){
            echo '<script>alert("Success");window.location="../form.php";</script>';
        }else{
            echo mysqli_error($db);
        }
    }
?>