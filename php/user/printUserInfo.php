<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getUserByUsername($db,$id);
    $access= $data['isAdmin']!=NULL?"Agent":"Moderator";
    echo '<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-info-circle" aria-hidden="true"></i> Information</h5>
            <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>
          <div class="modal-body">
            <table style="margin:0 auto">
                <tr>
                    <td style="padding-right:1rem">Username</td>
                    <td style="padding-right:1rem">:</td>
                    <td>'.$data['username'].'</td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td style="padding-right:1rem">:</td>
                    <td>'.$data['password'].'</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td style="padding-right:1rem">:</td>
                    <td>'.$data['email'].'</td>
                </tr>
                <tr>
                    <td>User Access</td>
                    <td style="padding-right:1rem">:</td>
                    <td>'.$access.'</td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">';
            if($_SESSION['access'] == 1){
                echo '
                <a href="#" style="margin-left:7%" class="link-dark mr-auto" onclick="editUser(\''.$data['username'].'\')" data-toggle="modal" data-target="#userInfo"><i class="fas fa-edit"></i>Edit</a>
                <a href="#" style="margin-right:1rem" onclick="setAccess(\''.$data['username'].'\','.$data['isAdmin'].')" data-toggle="modal" data-target="#changeAccess"><span>Change Access</span></a>';
            }
            
          echo '
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>';
?>