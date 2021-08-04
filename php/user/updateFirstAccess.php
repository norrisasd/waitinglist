<?php
    require '../functions.php';
    $_SESSION['login']=true;
    $user = $_SESSION['username'];
    $query = "UPDATE `user` SET `first_access`= 1 WHERE username = '$user' ";
    if(!mysqli_query($db,$query)){
        echo mysqli_error($db);
    }
?>