<?php
    require '../functions.php';
    if(!empty($_POST['list'])){
        foreach($_POST['list'] as $id){
            $data = getClientById($db,$id);
            $retval=deleteClient($db,$id);
            if(!$retval){
                break;
            }else{
                $_SESSION['clientDeleted'].="\t\t".$data['client_id']."\t\t".$data['client_name']."\t\t".$data['client_phone']."\t\t".$data['client_email']."\r\n";
            }
        }
    }else{
        echo '';
    }
    if($retval){
        echo 'Deleted';
    }else{
        echo 'Error';
    }
?>