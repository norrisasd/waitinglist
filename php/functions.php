<?php
    require 'conn.php';
    function displayTemplates($db){
        $query="SELECT * FROM emailtemplates";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                echo'
                    <option value="'.$data['TemplateName'].'">'.$data['TemplateName'].'</option>
                ';
            }
        }else{
            echo mysqli_error($db);
        }
    }
    function displayAllUser($db){
        $query="SELECT * FROM user";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $access= $data['isAdmin']==NULL?"FALSE":"TRUE";
                $edit=$data['isAdmin']==1 ?'':'';
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['username'].'"></th>';
                    if($_SESSION['access']==1){
                        echo'<td><a href="#" onclick="info(\''.$data['username'].'\')" data-toggle="modal" data-target="#info">'.$data['username'].'</a></td>';
                    }else{
                        echo '<td>'.$data['username'].'</td>';
                    }
                echo '<td>'.$data['email'].'</td>
                    <td>'.$access.'</td>';
                    if($_SESSION['access'] == 1){
                        if($data['isAdmin']== NULL ){
                            echo '
                             <td><a href="#" onclick="makeAdmin(\''.$data['username'].'\')">Grant Access</a></td>';
                         }else if($data['isAdmin'] == 0){
                             echo '
                             <td><a href="#" onclick="removeAdmin(\''.$data['username'].'\')">Remove Access</a></td>';
                         }else{
                            echo '<td></td>';
                         }
                         echo '<td><a href="#" onclick="editUser(\''.$data['username'].'\')" data-toggle="modal" data-target="#userInfo"><i class="fas fa-edit"></i></a></td>';
                    }else{
                        echo'<td></td>';
                    }
                echo $edit .'
                </tr>
                ';
            }
        }
    }
    function displayAllClients($db){
        $query="SELECT * FROM clients";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $check = $data['client_dnd'] == 1?"checked":"";
                $enable = $data['client_enabled'] == 1?"Disabled":"Enabled";
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['client_id'].'"></th>
                    <td><a href="#" onclick="info('.$data['client_id'].')" data-toggle="modal" data-target="#info">'.$data['client_name'].'</a></td>
                    <td>'.$data['client_phone'].'</td>
                    <td>'.$data['client_email'].'</td>
                    <td>'.$data['client_date_created'].'</td>
                    <td><input type="checkbox" class="form-check-input" style="margin : 0.4rem 0.5rem;height:15px;width:15px" id="'.$data['client_id'].'" value="'.$data['client_dnd'].'" onclick="updateDND('.$data['client_id'].')" autocomplete="off" '.$check.'></td>
                    <td>'.$enable.'</td>
                    <td><a href="#" onclick="editClient('.$data['client_id'].')" data-toggle="modal" data-target="#clientInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
                ';
            }
        }
    }
    function displayAllList($db){//read
        $query ="SELECT waitlist.* ,notification.notification_status
        FROM waitlist,notification
        INNER JOIN waitlist_notfication
        ON waitlist_notfication.waitlist_id=waitlist_id
        AND notification.notification_id = waitlist_notfication.notification_id
        WHERE waitlist_notfication.waitlist_id= waitlist.waitlist_id AND waitlist.waitlist_approval_sent = 0
        GROUP BY waitlist.waitlist_id desc;";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $color = $data['notification_status'] == 1?"gray":"black";
                echo'
                <tr class="tableItem" style="color:'.$color.';">
                    <th scope="row"><input type="checkbox"  name="list[]" value="'.$data['email'].'"><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
                ';
            }
        }
    }
    function displayAllListToday($db){//read
        $query ="SELECT waitlist.* ,notification.notification_status
        FROM waitlist,notification
        INNER JOIN waitlist_notfication
        ON waitlist_notfication.waitlist_id=waitlist_id
        AND notification.notification_id = waitlist_notfication.notification_id
        WHERE waitlist_notfication.waitlist_id= waitlist.waitlist_id AND waitlist.waitlist_approval_sent = 0 AND waitlist.waitlist_date_created = curdate()
        GROUP BY waitlist.waitlist_id desc;";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $color = $data['notification_status'] == 1?"gray":"black";
                echo'
                <tr class="tableItem" style="color:'.$color.';">
                    <th scope="row"><input type="checkbox"  name="list[]" value="'.$data['email'].'"><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
                ';
            }
        }
    }
    function displayAllListYesterday($db){//read
        $query ="SELECT waitlist.* ,notification.notification_status
        FROM waitlist,notification
        INNER JOIN waitlist_notfication
        ON waitlist_notfication.waitlist_id=waitlist_id
        AND notification.notification_id = waitlist_notfication.notification_id
        WHERE waitlist_notfication.waitlist_id= waitlist.waitlist_id AND waitlist.waitlist_approval_sent = 0 AND waitlist.waitlist_date_created = curdate() - INTERVAL 1 day
        GROUP BY waitlist.waitlist_id desc;";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $color = $data['notification_status'] == 1?"gray":"black";
                echo'
                <tr class="tableItem" style="color:'.$color.';">
                    <th scope="row"><input type="checkbox"  name="list[]" value="'.$data['email'].'"><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
                ';
            }
        }
    }
    function displayAllListThisMonth($db){
        $query ="SELECT waitlist.* ,notification.notification_status
        FROM waitlist,notification
        INNER JOIN waitlist_notfication
        ON waitlist_notfication.waitlist_id=waitlist_id
        AND notification.notification_id = waitlist_notfication.notification_id
        WHERE waitlist_notfication.waitlist_id= waitlist.waitlist_id AND waitlist.waitlist_approval_sent = 0 AND waitlist_date_created > curdate() - INTERVAL 30 day
        GROUP BY waitlist.waitlist_id desc;";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $color = $data['notification_status'] == 1?"gray":"black";
                echo'
                <tr class="tableItem" style="color:'.$color.';">
                    <th scope="row"><input type="checkbox"  name="list[]" value="'.$data['email'].'"><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
                ';
            }
        }
    }
    function displayAllListWeek($db){//read
        $query ="SELECT waitlist.* ,notification.notification_status
        FROM waitlist,notification
        INNER JOIN waitlist_notfication
        ON waitlist_notfication.waitlist_id=waitlist_id
        AND notification.notification_id = waitlist_notfication.notification_id
        WHERE waitlist_notfication.waitlist_id= waitlist.waitlist_id AND waitlist.waitlist_approval_sent = 0 AND waitlist_date_created > curdate() - INTERVAL 7 day
        GROUP BY waitlist.waitlist_id desc;";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $color = $data['notification_status'] == 1?"gray":"black";
                echo'
                <tr class="tableItem" style="color:'.$color.';">
                    <th scope="row"><input type="checkbox"  name="list[]" value="'.$data['email'].'"><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
                ';
            }
        }
    }
    function getClientDNDByWaitId($db,$id){
        $query = "SELECT * 
                FROM `clients` 
                INNER JOIN waitlist 
                ON clients.client_id=waitlist.client_id 
                WHERE waitlist.waitlist_id=$id";
        $result = mysqli_query($db,$query);
        if(mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            return $data['client_dnd'];
        }
    }
    function getEmailById($db,$id){
        $query ="SELECT * FROM waitlist WHERE waitlist_id = $id ";
        $result = mysqli_query($db,$query);
        if(mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            $data = $data['email'];
            return $data;
        }
    }
    function updateNotificationStatusWait($db){
        $query = "UPDATE `notification` SET `notification_status` = 1 WHERE notification.notification_status = 0 and notification.notification_subject = 'waitlist'";
        $result = mysqli_query($db,$query);
    }
    function updateNotificationStatusClient($db){
        $query = "UPDATE `notification` SET `notification_status` = 1 WHERE notification.notification_status = 0 and notification.notification_subject = 'client'";
        $result = mysqli_query($db,$query);
    }
    function updateNotificationStatusUser($db){
        $query = "UPDATE `notification` SET `notification_status` = 1 WHERE notification.notification_status = 0 and notification.notification_subject = 'user'";
        $result = mysqli_query($db,$query);
    }
    function displayAllTemplates($db){
        $query ="SELECT * FROM emailtemplates";
        $result=mysqli_query($db,$query);
        if($result){
            while($data=mysqli_fetch_assoc($result)){
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['template_id'].'"></th>
                    <td><a href="#" onclick="info('.$data['template_id'].')" data-toggle="modal" data-target="#info">'.$data['TemplateName'].'</a></td>
                    <td>'.$data['subject'].'</td>
                    <td>'.$data['message'].'</td>
                    <td><a href="#" onclick="editTemplate('.$data['template_id'].')" data-toggle="modal" data-target="#editTemp"><i class="fas fa-edit"></i></a></td>
                </tr>
                    ';
            }
        }
    }
    function deleteTemplate($db,$id){
        $query="DELETE FROM `emailtemplates` WHERE `template_id`= $id";
        $result=mysqli_query($db,$query);
        return $result;
    }
    function sendEmail($email,$subject,$message){
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='info.mauisnorkeling@gmail.com';
        $mail->Password='Mauisnorkeling21';
        $mail->setFrom('info.mauisnorkeling@gmail.com','Maui Snorkeling');
        $mail->addAddress($email);
        $mail->addReplyTo('info.mauisnorkeling@gmail.com');

        $mail->isHTML(true);
        $mail->Subject=$subject;
        $mail->Body=nl2br($message);
        $check = $mail->send();
        return $check;
    }
    function updateStatus($db,$id){
        $query = "UPDATE `waitlist` SET `waitlist_approval_sent`=1 WHERE `waitlist_id`='$id'";
        $result = mysqli_query($db,$query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function getListById($db,$id){
        $query="SELECT * FROM `waitlist` where `waitlist_id` = '$id'";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)===1){
            $data= mysqli_fetch_assoc($result);
            return $data;
        }
    }
    function exportFunction($data){
        $filename="data_".date("ymd").".xls";
        header('Content-type: application/vnd-ms-excel');
        header("Content-Disposition:attachment;filename=\"$filename\"");
        echo $data;
    }
    function getNotificationCount($db){
        $query="SELECT * FROM notification where notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getNotificationCountWait($db){
        $query="SELECT * FROM notification where notification_subject ='waitlist' AND notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getNotificationCountClient($db){
        $query="SELECT * FROM notification where notification_subject ='client' AND notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getNotificationCountUser($db){
        $query="SELECT * FROM notification where notification_subject ='user' AND notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getCountThisMonth($db){
        $query="SELECT * FROM `waitlist` where waitlist_date_created > curdate() - INTERVAL 30 day";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;
    }
    function getCountLastWeek($db){
        $query="SELECT * FROM `waitlist` where waitlist_date_created > curdate() - INTERVAL 7 day";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;
    }
    function getCountYesterday($db){
        $query="SELECT * FROM `waitlist` where waitlist_date_created = curdate() - INTERVAL 1 day";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;
    }
    function getCountToday($db){
        $query="SELECT * FROM `waitlist` where waitlist_date_created = curdate()";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;
    }
    function deleteClient($db,$id){
        $query="DELETE FROM clients where client_id=$id";
        $result=mysqli_query($db,$query);
        return $result;
    }
    function getClientById($db,$id){
        $query="SELECT * FROM clients where client_id=$id";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)==1){
            $data = mysqli_fetch_assoc($result);
            return $data;
        }
    }
    function getUserByUsername($db,$id){
        $query="SELECT * FROM user where username='$id'";
        $result=mysqli_query($db,$query);
        if(mysqli_num_rows($result)==1){
            $data = mysqli_fetch_assoc($result);
            return $data;
        }
    }
    function getWaitListDateCreated($db,$id){
        $data = getListById($db,$id);
        return $data['waitlist_date_created'];
    }
    function getAllActivity($db){
        $query="SELECT * FROM activity";
        $result=mysqli_query($db,$query);
        if($result){
            while($data=mysqli_fetch_assoc($result)){
                echo '<option value="'.$data['activity_name'].'">'.$data['activity_name'].'</option>';
            }
        }
    }
    function getEmailTemplateById($db,$id){
        $query="SELECT * FROM emailtemplates WHERE template_id=$id";
        $result=mysqli_query($db,$query);
        if($result && mysqli_num_rows($result) == 1){
            $data = mysqli_fetch_assoc($result);
            return $data;
        }
    }
?>