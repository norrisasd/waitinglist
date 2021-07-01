<?php
    require '../conn.php';
    $user=$_SESSION['username'];
    $pass=$_POST['password'];
    $passH=password_hash($pass,PASSWORD_DEFAULT);
    $query="UPDATE `user` SET `password`='$passH' WHERE username='$user'";
    if(mysqli_query($db,$query)){
        $_SESSION['pass']=$pass;
        echo 'Password Updated';
    }else{
        echo mysqli_error($db);
    }
?>