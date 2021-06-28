<?php
    require 'conn.php';
    $query = "UPDATE `notification` SET `notification_status` = '1' WHERE `notification`.`notification_status` = 0;";
    $result=mysqli_query($db,$query);
    echo '';
?>
