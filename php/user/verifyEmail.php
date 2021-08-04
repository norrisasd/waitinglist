<?php
    require_once '../conn.php';
    $email=$_GET['email'];
    $user =$_GET['username'];
    $query="SELECT * FROM `user` WHERE `username`='$user' AND `email`='$email'";
    $result = mysqli_query($db,$query);
    if($result){
        if(mysqli_num_rows($result)==1){
            echo 'exist';
        }else{
            echo 'Invalid Credentials';
        }
    }else{
        echo mysqli_error($db);
    }
    
?>