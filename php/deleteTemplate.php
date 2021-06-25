<?php
    include 'functions.php';
    if(isset($_POST['delTemp'])){
        if(!empty($_POST['list'])){
            foreach($_POST['list'] as $list){
                $retval=deleteTemplate($db,$list);
                if(!$retval){
                    break;
                }
            }
        }
        if(!$retval){
            echo '<script>alert("'.mysqli_error($db).'");window.location="../pages/emailtemplates.php";</script>';
        }else{
            echo '<script>alert("Deleted");window.location="../pages/emailtemplates.php";</script>';
        }
    }
?>