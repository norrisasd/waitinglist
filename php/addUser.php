<?php
    require 'functions.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $email=$_POST['email'];
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $query="INSERT INTO `user`(`username`, `password`, `email`, `isAdmin`) VALUES ('$user','$pass','$email',0)";
    $result=mysqli_query($db,$query);
    if($result){
        echo "Success";
    }else{
        echo "Username is Taken";
    }
?>