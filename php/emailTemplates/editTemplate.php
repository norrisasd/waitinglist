<?php
    require '../functions.php';
    $id = $_GET['id'];
    $data=getEmailTemplateById($db,$id);
    echo '
        <input type="text" value="'.$data['template_id'].'" id="tempID" style="display:none">
        <div class="form-group">
            <label for="exampleFormControlInput1">Template Name</label>
            <input type="text" class="form-control" id="etname" name="etname" value="'.$data['TemplateName'].'" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Subject</label>
            <input type="text" class="form-control" id="esub" name="esub" value="'.$data['subject'].'" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Message Body</label>
            <textarea class="form-control" id="emes" name="emes" rows="20" required>'.$data['message'].'</textarea>
        </div>
        ';
?>