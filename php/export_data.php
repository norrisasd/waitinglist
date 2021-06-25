<?php
//  require 'conn.php';
 include '../php/functions.php';
 $list=explode(",",$_GET['list']);
 $fields = array('ID', 'NAME', 'PHONE', 'EMAIL', 'START DATE', 'END DATE','Number of Passenger', 'Activity Name','Notes','Date Created','Waitlist_Enabled','Waitlist_Approval_Sent'); 
 
// Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    foreach($list as $id){
        $data = getListById($db,$id);
        $str = str_replace(array("\r\n","\n"),"",$data['waitlist_notes']);
        if(isset($data)){
            $rowData=array($data['waitlist_id'],$data['name'],$data['phone'],$data['email'],$data['waitlist_start_date'],$data['waitlist_end_date'],$data['waitlist_num_passengers'],$data['waitlist_activity_name'],$str,$data['waitlist_date_created'],$data['waitlist_enabled'],$data['waitlist_approval_sent']);
            $excelData .= implode("\t", array_values($rowData)) . "\n"; 
        }
    }
    $_SESSION['exportData']=$excelData;
    echo $excelData;

?>