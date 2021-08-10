<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getClientById($db,$id);
    $status = $data['client_enabled'] == 1 ? 'Enable':'Disable';
    $setStatus = $data['client_enabled'] == 0 ? 'Unarchive':'Archive';
    $dnd = $data['client_dnd'] == 1?'Check':'Uncheck';
    echo '<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-info-circle" aria-hidden="true"></i> Information</h5>
    <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
  </div>
  <div class="modal-body" style="margin:0 auto">
  <table style="margin:0 auto;">
        <tr>
        <td>Client ID</td>
        <td style="padding-right:1rem">:</td>
        <td style="margin-left:2%">'.$data['client_id'].'</td>
        </tr>
        <tr>
        <td>Name</td>
        <td>:</td>
        <td>'.$data['client_name'].'</td>
        </tr>
        <tr>
        <td>Phone</td>
        <td>:</td>
        <td>'.$data['client_phone'].'</td>
        </tr>
        <tr>
        <td>Email</td>
        <td>:</td>
        <td>'.$data['client_email'].'</td>
        </tr>
        <tr>
        <td style="padding-right:1rem">Date Created</td>
        <td>:</td>
        <td>'.$data['client_date_created'].'</td>
        </tr>
        <tr>
        <td>DND</td>
        <td>:</td>
        <td>'.$dnd.'</td>
        </tr>
        <tr>
        <td>Enabled</td>
        <td>:</td>
        <td>'.$status.'</td>
        </tr>
        <tr>
    </table>
  </div>
  <div class="modal-footer">
    <a href="#" style="margin-left:6%" class="mr-auto"  onclick="editClient('.$data['client_id'].')" data-toggle="modal" data-target="#clientInfo"><i class="fas fa-edit"></i>Edit</a>
    <a href="#" onclick="setStatus('.$data['client_id'].')" style="margin-right:3%" >'.$setStatus.'</a>
    <button type="button" class="btn btn-secondary" style="" data-dismiss="modal">Close</button>
  </div>';
?>