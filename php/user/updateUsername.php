<?php
    require '../conn.php';
    if(isset($_POST['editUser'])){
        $prevUser=$_SESSION['username'];
        $user=$_POST['username'];
        $query="UPDATE `user` SET `username`='$user' WHERE username='$prevUser'";
        if(mysqli_query($db,$query)){
            $_SESSION['username']=$user;
            echo '<script>alert("Username Updated");window.location="../../accountSettings.php"</script>';
        }else{
            echo '<script>alert("'.mysqli_error($db).'")</script>';
        }
    }
?>