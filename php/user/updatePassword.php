<?php
    require '../conn.php';
    if(isset($_POST['editPass'])){
        $user=$_SESSION['username'];
        $pass=$_POST['password'];
        $query="UPDATE `user` SET `password`='$pass' WHERE username='$user'";
        if(mysqli_query($db,$query)){
            $_SESSION['pass']=$pass;
            echo '<script>alert("Password Updated");window.location="../../accountSettings.php"</script>';
        }else{
            echo '<script>alert("'.mysqli_error($db).'")</script>';
        }
    }
?>