<?php
//  require 'conn.php';
 include '../php/functions.php';
 $list=explode(",",$_GET['list']);
 $fields = array('ID', 'NAME', 'PHONE', 'EMAIL', 'START DATE', 'END DATE','Number of Passenger', 'Activity Name','Notes','Date Created'); 
 
// Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    foreach($list as $email){
        $data = getListByEmail($db,$email);
        if(isset($data)){
            $rowData=array($data['waitlist_id'],$data['name'],$data['phone'],$data['email'],$data['waitlist_start_date'],$data['waitlist_end_date'],$data['waitlist_num_passengers'],$data['waitlist_activity_name'],$data['waitlist_notes'],$data['waitlist_date_created']);
            $excelData .= implode("\t", array_values($rowData)) . "\n"; 
        }
    }
    echo $excelData;
    $_SESSION['exportData']=$excelData;

?>