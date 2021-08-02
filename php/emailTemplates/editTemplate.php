<?php
    require '../functions.php';
    $id = $_GET['id'];
    $data=getEmailTemplateById($db,$id);
    echo json_encode($data);
?>