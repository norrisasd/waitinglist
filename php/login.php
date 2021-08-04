<?php
    require 'conn.php';
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="SELECT * FROM user where username='$user'";
    $result=mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) == 1){
        if($pass == $data['password']){
            if($data['first_access']==0){
                echo 'first';
            }else{
                $_SESSION['login']=true;
            }
            $_SESSION['countNotifW']=0;
            $_SESSION['countNotifC']=0;
            $_SESSION['countNotifU']=0;
            $_SESSION['username']=$user;
            $_SESSION['pass']=$pass;
            $_SESSION['email']=$data['email'];
            $_SESSION['access']=$data['isAdmin'];
            $_SESSION['img']=$data['image_file'];
            if($data['isAdmin'] == 0){
                $_SESSION['clientDeleted']='';
                $_SESSION['emailSent']='';
                $_SESSION['approvalSent']='';
                $_SESSION['dndUpdated']='';
            }
            
        }else{
            echo 'Invalid Password';
        }
    }else{
        echo 'Invalid Username';
    }
        

?>