<?php
    require 'functions.php';
    if(!empty($_POST['list'])){
        foreach($_POST['list'] as $list){
            $retval=deleteClient($db,$list);
            if(!$retval){
                break;
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