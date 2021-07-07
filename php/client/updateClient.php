<?php
    require '../functions.php';
    $id =$_POST['id'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $query="UPDATE `clients` SET `client_name`='$name',`client_phone`='$phone',`client_email`='$email' WHERE client_id = $id ";
    $result=mysqli_query($db,$query);
    if($result){
        echo 'Updated';
    }else{
        echo mysqli_error($db);
    }
?>