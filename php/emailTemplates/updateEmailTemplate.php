<?php
    require '../functions.php';
    $id = $_POST['tempid'];
    $tname=$_POST['tname'];
    $message=$_POST['mes'];
    $subject=$_POST['sub'];
    $query = "UPDATE `emailtemplates` SET `TemplateName`='$tname',`subject`='$subject',`message`='$message' WHERE template_id=$id";
    $result=mysqli_query($db,$query);
    if($result){
        echo 'Updated';
    }else{
        echo mysqli_error($db);
    }
?>