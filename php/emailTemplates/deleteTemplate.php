<?php
    include '../functions.php';
    if(!empty($_POST['list'])){
        foreach($_POST['list'] as $list){
            $retval=deleteTemplate($db,$list);
            if(!$retval){
                break;
            }
        }
    }
    if(!$retval){
        echo mysqli_error($db);
    }else{
        echo 'Deleted';
    }
?>