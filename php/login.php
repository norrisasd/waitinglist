<?php
    require 'conn.php';
    if(isset($_POST['login'])){
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $query="SELECT * FROM user where username='$user' AND password='$pass'";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['login']=true;
            $_SESSION['username']=$user;
            $_SESSION['pass']=$pass;
            echo '<script>window.location="../index.php";</script>';
        }else{
            echo '<script>alert("Invalid Credentials");window.location="../loginPage.php"</script>';
        }
        
    }
?>