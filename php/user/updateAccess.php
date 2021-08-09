<?php
    require '../functions.php';
    $user=$_GET['user'];
    $type=$_GET['type'];
    $query="UPDATE user SET isAdmin = $type WHERE username='$user'";
    $result=mysqli_query($db,$query);
    if($result){
        echo 'Success';
        if($_SESSION['access']==1 && $user == $_SESSION['username']){
            $_SESSION['access'] = $type;
        }
    }else{
        echo mysqli_error($db);
    }
?>