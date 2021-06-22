<?php
    include 'functions.php';
    require 'conn.php';
    if(isset($_POST['delTemp'])){
        if(!empty($_POST['list'])){
            foreach($_POST['list'] as $list){
                deleteTemplate($db,$list);
            }
        }
        header("Location: ../pages/emailtemplates.php");
    }
?>