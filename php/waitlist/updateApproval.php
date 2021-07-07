<?php
    require '../functions.php';
    foreach($_POST['list'] as $id){
        $retval = updateStatus($db,$id);
        if(!$retval){
            break;
        }
    }
    if(!$retval){
        echo mysqli_error($db);
    }else{
        echo 'Approved';
    }
?>