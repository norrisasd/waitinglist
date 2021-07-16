<?php
    require '../functions.php';
    if(!empty($_POST['list'])){
        foreach($_POST['list'] as $id){
            $data = getClientById($db,$id);
            $retval=disableClient($db,$id);
            $retval1=disableWaitByClientId($db,$id);
            if(!$retval || !$retval1){
                break;
            }else{
                if($_SESSION['access'] == 0){
                    $_SESSION['clientDeleted'].="\t\t".$data['client_id']."\t\t".$data['client_name']."\t\t".$data['client_phone']."\t\t".$data['client_email']."\r\n";
                }
                
            }
        }
    }else{
        echo '';
    }
    if($retval && $retval1){
        echo 'Disabled';
    }else{
        echo 'Error';
    }
?>