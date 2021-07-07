<?php
//  require 'conn.php';
 include '../functions.php';
 $list=explode(",",$_GET['list']);
 $fields = array('USERNAME', 'PASSWORD', 'EMAIL', 'ISADMIN'); 
 
// Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    foreach($list as $id){
        $data = getUserByUsername($db,$id);
        if(isset($data)){
            $rowData=array($data['username'],$data['password'],$data['email'],$data['isAdmin']);
            $excelData .= implode("\t", array_values($rowData)) . "\n"; 
        }
    }
    $_SESSION['exportData']=$excelData;
    echo $excelData;

?>