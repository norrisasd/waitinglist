<?php
    require '../functions.php';
    $id = $_POST['id'];
    $dnd = $_POST['dnd'];
    $data = getClientById($db,$id);
    $query = "UPDATE clients SET client_dnd = $dnd WHERE client_id =$id ";
    $result = mysqli_query($db,$query);
    if($result){
        if($_SESSION['access']==0){
            $_SESSION['dndUpdated'].="\t\t".$data['client_id']."\t\t".$data['client_name']."\t\t".$data['client_phone']."\t\t".$data['client_email']."FROM ".$data['client_dnd']." TO ".$dnd."\r\n";
        }
        echo 'Updated';
    }else{
        echo mysqli_error($db);
    }
?>