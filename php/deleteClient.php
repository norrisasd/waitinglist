<?php
    require 'functions.php';
    if(isset($_POST['deleteClient'])){
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
            echo '<script>alert("Deleted");window.location="../pages/client.php";</script>';
        }else{
            echo '<script>alert("Error")</script>';
        }
    }
?>