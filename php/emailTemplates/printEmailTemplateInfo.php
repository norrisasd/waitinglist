<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getEmailTemplateById($db,$id);
    echo '
    <div class="form-group" style="margin: 0 auto">
        <label for="exampleFormControlInput1">Template ID: '.$id.'</label>
        
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Template Name</label>
        <input type="text" class="form-control" value="'.$data['TemplateName'].'" disabled>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Subject</label>
        <input type="text" class="form-control" value="'.$data['subject'].'" disabled>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Message</label>
        <textarea class="form-control" rows="3" disabled>'.$data['message'].'</textarea>
    </div>
        ';
?>