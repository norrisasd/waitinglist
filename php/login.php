<?php
    require 'conn.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="SELECT * FROM user where username='$user'";
    $result=mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) == 1){
        if(password_verify($pass,$data['password'])){
            $_SESSION['login']=true;
            $_SESSION['username']=$user;
            $_SESSION['pass']=$pass;
            $_SESSION['email']=$data['email'];
        }else{
            echo 'Invalid Password';
        }
    }else{
        echo 'Invalid Username';
    }
        

?>