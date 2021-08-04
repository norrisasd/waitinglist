<?php
    require '../functions.php';
    $user=$_POST['username'];
    $pass=$_POST['pass'];
    $query="UPDATE `user` SET `password`='$pass' WHERE username='$user'";
    if(mysqli_query($db,$query)){
        echo 'Updated';
    }else{
        echo mysqli_error($db);
    }
?>