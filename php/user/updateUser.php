<?php
    require '../functions.php';
    $puser =$_POST['prevUser'];
    $user=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $query="UPDATE `user` SET `username`='$user',`password`='$password',`email`='$email' WHERE username = '$puser' ";
    $result=mysqli_query($db,$query);
    if($result){
        echo 'Updated';
    }else{
        echo mysqli_error($db);
    }
?>