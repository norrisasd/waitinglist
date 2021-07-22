<?php
    require '../functions.php';
    $id = $_POST['waitID']; 
    $dcreated = getWaitListDateCreated($db,$id);
    $client_id=getListById($db,$id);
    $client_id=$client_id['client_id'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];
    // if($edate<$sdate || $sdate<$dcreated){
    //     echo 'Date Error';
    //     return;
    // }
    $passengers=$_POST['passengers'];
    $aname=$_POST['aname'];
    $notes=$_POST['notes'];
    $query="UPDATE `waitlist` SET `name`='$name',`phone`='$phone',`email`='$email',`waitlist_start_date`='$sdate',`waitlist_end_date`='$edate',`waitlist_num_passengers`='$passengers',`waitlist_activity_name`='$aname',`waitlist_notes`='$notes' WHERE waitlist_id=$id";
    $result=mysqli_query($db,$query);
    if($result){
        $query ="UPDATE clients SET client_name = '$name',client_phone=$phone,client_email='$email' WHERE client_id =$client_id";
        $result=mysqli_query($db,$query);
        if($result){
            echo 'Success';
        }else{
            echo mysqli_error($db);
        }
        
    }else{
        echo 'Error';
    }
?>