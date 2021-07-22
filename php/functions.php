<?php
    require 'conn.php';
    $count = getNotificationCount($db);
    $countW = getNotificationCountWait($db);
    $countC = getNotificationCountClient($db);
    $countU = getNotificationCountUser($db);
    if(!isset($_SESSION['countNotifW']) || $_SESSION['countNotifW']==0 || $_SESSION['countNotifW'] !=$countW ){
        if($_SESSION['countNotifW'] != $countW && $countW == 0){
          $_SESSION['countNotifW']+=0;
        }else{
          $_SESSION['countNotifW']=$countW;
        }
    }
    if(!isset($_SESSION['countNotifC']) || $_SESSION['countNotifC']==0 || $_SESSION['countNotifC'] !=$countC){
        if($_SESSION['countNotifC'] != $countC&& $countC == 0){
          $_SESSION['countNotifC']+=0;
        }else{
          $_SESSION['countNotifC']=$countC;
        }
    }
    if(!isset($_SESSION['countNotifU']) || $_SESSION['countNotifU']==0 || $_SESSION['countNotifU'] !=$countU ){
        if($_SESSION['countNotifU'] != $countU&& $countU == 0){
          $_SESSION['countNotifU']+=0;
        }else{
          $_SESSION['countNotifU']=$countU;
        }
    }
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
                echo $edit .'
                </tr>
                ';
            }
        }
    }
    function displayAllClientsDisabled($db){
        $query="SELECT * FROM clients WHERE client_enabled = 0";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $check = $data['client_dnd'] == 1?"checked":"";
                $enable = $data['client_enabled'] == 1?"Enabled":"Disabled";
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['client_id'].'"></th>
                    <td><a href="#" onclick="info('.$data['client_id'].')" data-toggle="modal" data-target="#info">'.$data['client_name'].'</a></td>
                    <td>'.$data['client_phone'].'</td>
                    <td>'.$data['client_email'].'</td>
                    <td>'.$data['client_date_created'].'</td>
                    <td><input type="checkbox" class="form-check-input" style="margin : 0.4rem 0.5rem;height:15px;width:15px" id="'.$data['client_id'].'" value="'.$data['client_dnd'].'" onclick="updateDND('.$data['client_id'].')" autocomplete="off" '.$check.'></td>
                    <td>'.$enable.'</td>
                </tr>
                ';
            }
        }
    }
    function displayAllClients($db){
        $query="SELECT * FROM clients WHERE client_enabled=1 GROUP BY client_id desc";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                $check = $data['client_dnd'] == 1?"checked":"";
                $enable = $data['client_enabled'] == 1?"Active":"Inactive";
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['client_id'].'"></th>
                    <td><a href="#" onclick="info('.$data['client_id'].')" data-toggle="modal" data-target="#info">'.$data['client_name'].'</a></td>
                    <td>'.$data['client_phone'].'</td>
                    <td>'.$data['client_email'].'</td>
                    <td>'.$data['client_date_created'].'</td>
                    <td><input type="checkbox" class="form-check-input" style="margin : 0.4rem 0.5rem;height:15px;width:15px" id="'.$data['client_id'].'" value="'.$data['client_dnd'].'" onclick="updateDND('.$data['client_id'].')" autocomplete="off" '.$check.'></td>
                    <td>'.$enable.'</td>
                </tr>
                ';
            }
        }
    }
    function displayAllList($db,$displayType,$dateCreated){//read
        
        if($displayType == ''){
            $disT='';
        }else{
            $disT="AND waitlist.waitlist_approval_sent =".$displayType;
        }
        if($dateCreated == ''){
            $dateC = "";
        }else{
            $dateC = "AND waitlist.waitlist_date_created ='$dateCreated'";
        }
        $query ="SELECT waitlist.*,notification_added.notification_status
        FROM `waitlist`,`notification_added`
        WHERE waitlist.waitlist_id=notification_added.waitlist_id AND waitlist.waitlist_enabled=1 $disT $dateC
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
                    <td>'.$data['waitlist_date_created'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                </tr>
                ';
            }
        }else{
            echo mysqli_error($db);
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
        $query = "UPDATE `notification_added` SET `notification_status` = 1 WHERE notification_added.notification_status = 0 and notification_added.notification_type = 'waitlist'";
        $result = mysqli_query($db,$query);
    }
    function updateNotificationStatusClient($db){
        $query = "UPDATE `notification_added` SET `notification_status` = 1 WHERE notification_added.notification_status = 0 and notification_added.notification_type = 'client'";
        $result = mysqli_query($db,$query);
    }
    function updateNotificationStatusUser($db){
        $query = "UPDATE `notification_added` SET `notification_status` = 1 WHERE notification_added.notification_status = 0 and notification_added.notification_type = 'user'";
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
    function setEmailSentRecord($db,$id,$tempname){
        $query ="INSERT INTO `emailsentrecords`(`waitlist_id`, `template_name`) VALUES ($id,'$tempname')";
        $result= mysqli_query($db,$query);
        return $result;
    }
    function getEmailSentRecordByWaitId($db,$id){
        $query = "SELECT * FROM emailsentrecords WHERE waitlist_id = $id";
        $result=mysqli_query($db,$query);
        if($result){
            return mysqli_fetch_assoc($result);
        }
    }
    function sendEmail($email,$subject,$message){
        // $mail = new PHPMailer;
        // $mail->isSMTP();
        // $mail->Host='smtp.gmail.com';
        // $mail->Port=587;
        // $mail->SMTPAuth=true;
        // $mail->SMTPSecure='tls';

        // $mail->Username='info.mauisnorkeling@gmail.com';
        // $mail->Password='Mauisnorkeling21';
        // $mail->setFrom('info.mauisnorkeling@gmail.com','Maui Snorkeling');
        // $mail->addAddress($email);
        // $mail->addReplyTo('info.mauisnorkeling@gmail.com');

        // $mail->isHTML(true);
        // $mail->Subject=$subject;
        // $mail->Body=nl2br($message);
        // $check = $mail->send();
        // return $check;
        $sender = $_SESSION['sender'];
        $senderName = 'Lani Kai';
        // Replace smtp_username with your Amazon SES SMTP user name.
        $usernameSmtp = $_SESSION['smtpUser'];
        // Replace smtp_password with your Amazon SES SMTP password.
        $passwordSmtp = $_SESSION['smtpPass'];
        // If you're using Amazon SES in a region other than US West (Oregon),
        // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
        // endpoint in the appropriate region.
        $host = $_SESSION['smtpHost'];
        $port = $_SESSION['smtpPort'];
        $mail = new PHPMailer(true);
        $check = false;
        try {
            // Specify the SMTP settings.
            $mail->isSMTP();
            $mail->setFrom($sender, $senderName);
            $mail->Username   = $usernameSmtp;
            $mail->Password   = $passwordSmtp;
            $mail->Host       = $host;
            $mail->Port       = $port;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';

            // Specify the message recipients.
            $mail->addAddress($email);
            // You can also add CC, BCC, and additional To recipients here.
            $mail->addReplyTo($sender);

            // Specify the content of the message.
            $mail->isHTML(true);
            $mail->Subject    = $subject;
            $mail->Body       = nl2br($message);
            $mail->addEmbeddedImage(dirname(__FILE__).'/logo-small.png','logo_image');
            $check = $mail->Send();
        } catch (phpmailerException $e) {
            echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
        } catch (Exception $e) {
            echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
        }
        return $check;
    }
    function disableWaitByClientId($db,$id){
        $query="UPDATE `waitlist` SET `waitlist_enabled`=0 WHERE client_id = $id";
        $result =mysqli_query($db,$query);
        return $result;
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
        $query="SELECT * FROM notification_added where notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getNotificationCountWait($db){
        $query="SELECT * FROM notification_added where notification_type ='waitlist' AND notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getNotificationCountClient($db){
        $query="SELECT * FROM notification_added where notification_type ='client' AND notification_status=0";
        $result=mysqli_query($db,$query);
        if($result){
            $count = mysqli_num_rows($result);
            return $count;
        }
    }
    function getNotificationCountUser($db){
        $query="SELECT * FROM notification_added where notification_type ='user' AND notification_status=0";
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
    function getEmailSentCountYesterday($db){
        $query="SELECT * FROM `waitlist_notfication` where waitlist_notification_create_date = curdate() - INTERVAL 1 day";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;

    }
    function getEmailSentCountToday($db){
        $query="SELECT * FROM `waitlist_notfication` where waitlist_notification_create_date = curdate()";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;

    }
    function getEmailSentCountWeek($db){
        $query="SELECT * FROM `waitlist_notfication` where waitlist_notification_create_date > curdate() - INTERVAL 7 day";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;

    }
    function getEmailSentCountMonth($db){
        $query="SELECT * FROM `waitlist_notfication` where waitlist_notification_create_date > curdate() - INTERVAL 30 day";
        $result =mysqli_query($db,$query);
        $count = mysqli_num_rows($result);
        return $count;

    }
    function deleteClient($db,$id){
        $query="DELETE FROM clients where client_id=$id";
        $result=mysqli_query($db,$query);
        return $result;
    }
    function disableClient($db,$id){
        $query="UPDATE clients set client_enabled = 0 where client_id=$id";
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
    function getAutoIncrementNotification($db){
        $dbName=$_SESSION['db'];
        $qAI="SELECT `AUTO_INCREMENT`as AI FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$dbName' AND TABLE_NAME = 'notification';";
        $rAI=mysqli_query($db,$qAI);
        $ai=mysqli_fetch_assoc($rAI);
        $ai=$ai['AI'];  //Auto Increment of waitlist
        return $ai;
    }
    function createEmailNotification($db,$subject,$message){
        $query = "INSERT INTO `notification`(`notification_subject`, `notification_email`) VALUES ('$subject','$message')";
        $result = mysqli_query($db,$query);
    }
    function createWaitlistNotification($db,$waitID,$notifID){
        $query ="INSERT INTO `waitlist_notfication`(`waitlist_id`, `notification_id`, `waitlist_notification_create_date`) VALUES ($waitID,$notifID,CURDATE())";
        $result = mysqli_query($db,$query);
    }
    function enableClientById($db,$id){
        $query="UPDATE clients SET  client_enabled = 1 WHERE client_id = $id";
        $result=mysqli_query($db,$query);
        return $result;
    }
    function enableWaitlistByClientId($db,$id){
        $query="UPDATE waitlist SET  waitlist_enabled = 1 WHERE client_id = $id";
        $result=mysqli_query($db,$query);
        return $result;
    }
    function checkEmail($email){
        
    }
?>