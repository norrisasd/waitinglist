<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getEmailTemplateById($db,$id);
    $message = 'Aloha <Full Name>, '."\n\n";
    $attachment="\n\nBook Now\n
Maui Snorkeling Lani Kai
mauisnorkeling.com
888.983.8080
                ";
    echo '
    <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-info-circle" aria-hidden="true"></i> Email Template Info</h5>
          <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>
    <div class="modal-body">
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
    </div>
    
    <div class="modal-footer">
        <a href="#" style="margin-right:63%" onclick="editTemplate('.$data['template_id'].')" data-toggle="modal" data-target="#editTemp"><i class="fas fa-edit"></i></a>
        <a href="#" style="margin-right:1%" onclick="deleteTemplate()">Delete</a><input type="text" id="deleteIndividual" value="'.$data['template_id'].'">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
        ';
?>