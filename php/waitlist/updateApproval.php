<?php
    require '../functions.php';
    foreach($_POST['list'] as $id){
        $data = getListById($db,$id);
        $retval = updateStatus($db,$id);
        if(!$retval){
            break;
        }else{
            $_SESSION['approvalSent'].="\t\t".$data['waitlist_id']."\t\t".$data['name']."\t\t".$data['phone']."\t\t".$data['email']."\r\n";
        }
    }
    if(!$retval){
        echo mysqli_error($db);
    }else{
        echo 'Approved';
    }
?>