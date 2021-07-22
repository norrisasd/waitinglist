<?php
    require 'functions.php';
    $id = $_GET['id'];
    $id = urldecode($id);
    $id = base64_decode($id);
    $check = disableClient($db,$id);
    if($check){
        $check = disableWaitByClientId($db,$id);
        if($check){
            header("Location: ../pages/confirmation/UnsubscribeSuccess.php");
        }else{
            echo 'FAILED';
        }
    }else{
        echo 'FAILED';
    }
?>