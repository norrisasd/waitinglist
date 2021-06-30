<?php
    require 'functions.php';
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $query="INSERT INTO `clients`(`client_name`, `client_phone`, `client_email`,`client_date_created` ) VALUES ('$name','$phone','$email',CURDATE())";
        $result=mysqli_query($db,$query);
        if($result){
            echo '<script>alert("Success");window.location="../clientForm.php";</script>';
        }else{
            echo mysqli_error($db);
        }
    }
    
?>