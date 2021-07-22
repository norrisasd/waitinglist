<?php
    require '../functions.php';
    foreach($_POST['list'] as $id){
        $retval = enableClientById($db,$id);
        $retval1 = enableWaitlistByClientId($db,$id);
        if(!$retval || !$retval1){
            break;
        }
    }
    if(!$retval){
        echo 'there was an error';
    }else{
        echo 'Enabled';
    }
?>