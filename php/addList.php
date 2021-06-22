<?php
    require 'conn.php';
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $passengers=$_POST['passengers'];
        $aname=$_POST['aname'];
        $notes=$_POST['notes'];
        $query="INSERT INTO `waitlist`(`name`, `phone`, `email`, `waitlist_start_date`, `waitlist_end_date`, `waitlist_num_passengers`, `waitlist_activity_name`, `waitlist_notes`, `waitlist_date_created`, `waitlist_enabled`, `waitlist_approval_sent`) VALUES ('$name','$phone','$email','$sdate','$edate',$passengers,'$aname','$notes',CURDATE(),0,0)";
        $result=mysqli_query($db,$query);
        if($result){
            echo 'success';
        }else{
            echo mysqli_error($db);
        }
    }
?>