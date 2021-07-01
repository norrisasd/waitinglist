<?php
    require 'functions.php';
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $query="INSERT INTO `clients`(`client_name`, `client_phone`, `client_email`,`client_date_created` ) VALUES ('$name','$phone','$email',CURDATE())";
        $result=mysqli_query($db,$query);
        if($result){
            echo 'Success';
        }else{
            echo mysqli_error($db);
        }
    
?>