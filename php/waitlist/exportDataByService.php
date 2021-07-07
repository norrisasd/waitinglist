<?php
    include '../functions.php';
    $service = $_GET['service'];
    $fields = array('ID', 'NAME', 'PHONE', 'EMAIL', 'START DATE', 'END DATE','Number of Passenger', 'Activity Name','Notes','Date Created','Waitlist_Enabled','Waitlist_Approval_Sent'); 
    $excelData = implode("\t", array_values($fields)) . "\n"; 
    $query ="SELECT * FROM waitlist where waitlist_activity_name='$service'";
    $result=mysqli_query($db,$query);
    if($result){
        if(mysqli_num_rows($result)>=1){
            while($data=mysqli_fetch_assoc($result)){
                $rowData=array($data['waitlist_id'],$data['name'],$data['phone'],$data['email'],$data['waitlist_start_date'],$data['waitlist_end_date'],$data['waitlist_num_passengers'],$data['waitlist_activity_name'],$data['waitlist_notes'],$data['waitlist_date_created'],$data['waitlist_enabled'],$data['waitlist_approval_sent']);
                $excelData .= implode("\t", array_values($rowData)) . "\n"; 
            }
        }
    }else{
        $_SESSION['exportData']=mysqli_error($db);
    }
    
   $_SESSION['exportData']=$excelData;
   echo $excelData;
?>