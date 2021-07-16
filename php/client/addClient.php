<?php
    require '../functions.php';
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $query="INSERT INTO `clients`(`client_name`, `client_phone`, `client_email`,`client_date_created`,`client_enabled` ) VALUES ('$name','$phone','$email',CURDATE(),1)";
    $result=mysqli_query($db,$query);

    $nquery="INSERT INTO `notification`( `notification_subject`, `notification_email`, `notification_status`) VALUES ('client','$email',0)";
    $nresult=mysqli_query($db,$nquery);
    if($result == $nresult){
        echo 'Success';
    }else{
        echo mysqli_error($db);
    }
    
?>