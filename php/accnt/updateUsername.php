<?php
    require '../functions.php';
    $prevUser=$_SESSION['username'];
    $user=$_POST['username'];
    $query="UPDATE `user` SET `username`='$user' WHERE username='$prevUser'";
    if(mysqli_query($db,$query)){
        $_SESSION['username']=$user;
        echo 'Username Updated';
    }else{
        echo "Username is Taken";
    }
?>