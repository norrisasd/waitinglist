<?php
    require '../functions.php';
    $user=$_GET['user'];
    $query="UPDATE user SET isAdmin = 0 WHERE username='$user'";
    $result=mysqli_query($db,$query);
    if($result){
        echo 'Success';

    }else{
        echo mysqli_error($db);
    }
?>