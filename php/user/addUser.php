<?php
    require '../functions.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $email=$_POST['email'];
    $query="INSERT INTO `user`(`username`, `password`, `email`) VALUES ('$user','$pass','$email')";
    $result=mysqli_query($db,$query);
    $nquery="INSERT INTO `notification`( `notification_subject`, `notification_email`, `notification_status`) VALUES ('user','$email',0)";
    $nresult=mysqli_query($db,$nquery);
    if($result == $nresult){
        echo "Success";
    }else{
        echo "Username is Taken";
    }
?>