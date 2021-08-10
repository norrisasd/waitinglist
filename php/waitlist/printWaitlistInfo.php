<?php
    require '../functions.php';
    $id=$_GET['id'];
    $data=getListById($db,$id);
    $notes = $data['waitlist_notes'] == ''?"None": $data['waitlist_notes'];
    $notes = nl2br($notes);
    $sent = $data['waitlist_approval_sent'] == 1?"Sent ":"Sent ";
    $query = "SELECT * FROM `notification` INNER JOIN waitlist_notfication ON notification.notification_id = waitlist_notfication.notification_id WHERE waitlist_notfication.waitlist_id = $id ORDER BY waitlist_notification_create_date desc ";//waitlist notification 
    $status = $data['waitlist_enabled'] == 1 ?"Enabled":"Disabled";
    $setStatus = $data['waitlist_enabled'] == 1 ?"Archive":"Unarchive";
    $result=mysqli_query($db,$query);
    $ctr =0;
    $dnd = getClientDNDByWaitId($db,$id);
    $check = $dnd == 1?"checked":"";
    echo '<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle" aria-hidden="true" style="margin-top:0.2rem"></i> Information</h5>
    <button type="button" class="btn btn-outline-dark" style="border:0;border-radius:50%" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
  </div>
  <div class="modal-body" style="margin:0 auto;word-wrap:break-word">
  <table style="margin:0 auto;display:block;border-collapse: collapse;">
          <tr>
          <td>Waitlist ID</td>
          <td style="padding-right:1rem">:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['waitlist_id'].'</td>
          </tr>
          <tr>
          <td>Name</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['name'].'</td>
          </tr>
          <tr>
          <td>Phone</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['phone'].'</td>
          </tr>
          <tr>
          <td>Email</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td style="word-wrap:break-word">'.$data['email'].'</td>
          </tr>
          <tr>
          <td>Start Date</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['waitlist_start_date'].'</td>
          </tr>
          <tr>
          <td>End Date</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['waitlist_end_date'].'</td>
          </tr>
          <tr>
          <td>Passengers</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['waitlist_num_passengers'].'</td>
          </tr>
          <tr>
          <td>Service</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['waitlist_activity_name'].'</td>
          </tr>
          <tr>
          <td>Notes</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$notes.'</td>
          </tr>
          <tr>
          <tr>
          <td>Client ID</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['client_id'].'</td>
          </tr>
          <tr>
          <td style="padding-right:1rem">Date Created</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$data['waitlist_date_created'].'</td>
          </tr>
          <tr>
          <td>Status</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$status.'</td>
          </tr>
          <tr>
          <td>Email Sent</td>
          <td>:</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>'.$sent.mysqli_num_rows($result)." emails".'</td>
          </tr>';
          if($result && mysqli_num_rows($result) >0){
            echo'<tbody style="border:1px solid;padding:1% 0;margin auto;display:block;max-height:150px;width:100%;overflow:auto;">';
            while($temp=mysqli_fetch_assoc($result)){
              $str =$ctr==0?"Template Name":"";
              if($temp['template_name']==''){
                $tname="Custom";
              }else{
                $tname=$temp['template_name'];
              }
              echo'<tr style="margin-right:5%">
              <td>'.$str.'</td>
              <td style="padding-right:1rem"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="">'.$tname.' ('.$temp['waitlist_notification_create_date'].')'.'</td>
              </tr>';

              $ctr++;
            }
            echo'</tbody>';
          }        
          echo'<tr>
                <td>DND</td>
                <td>:</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" class="form-check-input" style="margin-left:3%;margin-top:-1%;height:15px;width:15px" id="'.$data['client_id'].'" value="'.$dnd.'" onclick="updateDND('.$data['client_id'].')" autocomplete="off" '.$check.'></td>
               </tr> 
          <input type="text" value="'.$data['waitlist_id'].'" id="waitIndID" style="display:none" >
      </table>
  </div>
  <div class="modal-footer">
    <a href="#" style="margin-left:6%" class="mr-auto" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i>Edit</a>
    <a href="#" style="padding-right:1%" onclick="setStatus('.$data['client_id'].')">'.$setStatus.'</a>
    <button type="button" class="btn btn-primary" onclick="turnoffCheck()" data-toggle="modal" data-target="#emailTemplate">Send Email</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>';
?>