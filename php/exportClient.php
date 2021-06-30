<?php
//  require 'conn.php';
 include '../php/functions.php';
 $list=explode(",",$_GET['list']);
 $fields = array('ID', 'NAME', 'PHONE', 'EMAIL', 'DATE CREATED', 'DND','ENABLED'); 
 
// Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    foreach($list as $id){
        $data = getClientById($db,$id);
        $str = str_replace(array("\r\n","\n"),"",$data['waitlist_notes']);
        if(isset($data)){
            $rowData=array($data['client_id'],$data['client_name'],$data['client_phone'],$data['client_email'],$data['client_date_created'],$data['client_dnd'],$data['client_enabled']);
            $excelData .= implode("\t", array_values($rowData)) . "\n"; 
        }
    }
    $_SESSION['exportData']=$excelData;
    echo $excelData;

?>