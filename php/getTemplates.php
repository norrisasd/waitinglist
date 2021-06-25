<?php 
    require 'conn.php';
    $tempName =$_GET['tempName'];
    $query ="SELECT * FROM emailtemplates WHERE TemplateName = '$tempName'";
    $result=mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($result);
    if($result){
        $text=$data['message']; 
        echo '
        <div class="form-group"  style="display:none">
            <label for="exampleFormControlInput1">Subject</label>
            <input type="text" class="form-control" id="emailsub" value="'.$data['subject'].'" placeholder="Subject" required>
        </div>
        <div class="form-group" style="display:none">
            <label for="exampleFormControlTextarea1">Message</label>
            <textarea class="form-control" id="emailmes" rows="3" required>'.$data['message'].'</textarea>
        </div>
         ';
         
    }
?>