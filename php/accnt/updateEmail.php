<?php
    require '../functions.php';
    $user=$_SESSION['username'];
    $email=$_POST['email'];
    $query="UPDATE `user` SET `email`='$email' WHERE username='$user'";
    if(mysqli_query($db,$query)){
        $_SESSION['email']=$email;
        echo 'Email Updated';
    }else{
        echo 'Error!';
    }
?>