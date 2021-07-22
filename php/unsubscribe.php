<?php
    require 'functions.php';
    $id = $_GET['id'];
    $check = disableClient($db,$id);
    if($check){
        $check = disableWaitByClientId($db,$id);
        if($check){
            header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
        }else{
            echo 'FAILED';
        }
    }else{
        echo 'FAILED';
    }
?>