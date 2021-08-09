<?php
    require '../functions.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $email=$_POST['email'];
    $type=$_POST['type'];
    list($trash,$domain) = explode('@',$email);
    if(!checkdnsrr($domain,'MX')){
        echo 'Email is not Valid!';
        return;
    }
    $query="INSERT INTO `user`(`username`, `password`, `email`,`isAdmin`) VALUES ('$user','$pass','$email',$type)";
    $result=mysqli_query($db,$query);
    $nquery="INSERT INTO `notification_added`( `notification_type`, `notification_status`) VALUES ('user',0)";
    $nresult=mysqli_query($db,$nquery);
    if($result == $nresult){
        echo "Success";
    }else{
        echo 'Username already exist';
    }
?>