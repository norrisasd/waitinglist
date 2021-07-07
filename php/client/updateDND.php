<?php
    require '../functions.php';
    $id = $_POST['id'];
    $query = "UPDATE clients SET client_dnd = 1 WHERE client_id =$id ";
    $result = mysqli_query($db,$query);
    if($result){
        echo 'Updated';
    }else{
        echo mysqli_error($db);
    }
?>