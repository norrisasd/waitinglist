<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getEmailTemplateById($db,$id);
    $message = 'Aloha <Full Name>, '."\n\n";
    $attachment="\n\nMaui Snorkeling Lani Kai
mauisnorkeling.com
888.983.8080
                ";
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
        <textarea class="form-control" rows="20" disabled>'.$message.$data['message'].$attachment.'</textarea>
    </div>
        ';
?>