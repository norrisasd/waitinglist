<?php
    require '../conn.php';
    $user=$_SESSION['username'];
    $pass=$_POST['password'];
    $query="UPDATE `user` SET `password`='$pass' WHERE username='$user'";
    if(mysqli_query($db,$query)){
        $_SESSION['pass']=$pass;
        echo 'Password Updated';
    }else{
        echo mysqli_error($db);
    }
?>