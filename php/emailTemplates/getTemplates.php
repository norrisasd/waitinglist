<?php 
    require '../functions.php';
    $tempName =$_GET['tempName'];
    $query ="SELECT * FROM emailtemplates WHERE TemplateName = '$tempName'";
    $result=mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
?>