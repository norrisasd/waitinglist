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
    function displayAllClients($db){
        $query="SELECT * FROM clients";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                echo'
                <tr class="tableItem" onclick="info()">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['client_id'].'"></th>
                    <td>'.$data['client_name'].'</td>
                    <td>'.$data['client_phone'].'</td>
                    <td>'.$data['client_email'].'</td>
                    <td>'.$data['client_date_created'].'</td>
                    <td>'.$data['client_dnd'].'</td>
                    <td>'.$data['client_enabled'].'</td>
                </tr>
                ';
            }
        }
    }
    function displayAllList($db){
        $query ="SELECT * FROM waitlist";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['email'].'"><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info""><a href="#">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                </tr>
                ';
            }
        }
    }
    function displayAllTemplates($db){
        $query ="SELECT * FROM emailtemplates";
        $result=mysqli_query($db,$query);
        if($result){
            while($data=mysqli_fetch_assoc($result)){
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['TemplateName'].'"></th>
                    <td>'.$data['TemplateName'].'</td>
                    <td>'.$data['subject'].'</td>
                    <td>'.$data['message'].'</td>
                </tr>

                    ';
            }
        }
    }
    function deleteTemplate($db,$tempname){
        $query="DELETE FROM `emailtemplates` WHERE `TemplateName`= '$tempname'";
        $result=mysqli_query($db,$query);
        return $result;
    }
    function sendEmail($email,$subject,$message){
        require '../phpmailer/PHPMailerAutoload.php';
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
    function updateStatus($db,$email){
        $query = "UPDATE `waitlist` SET `waitlist_approval_sent`=1 WHERE `email`='$email'";
        $result = mysqli_query($db,$query);
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
    if(isset($_POST['sendEmail'])){
        $subject=$_POST['subject1'];
        $message=$_POST['text1'];
        if(!empty($_POST['list'])){
            foreach($_POST['list'] as $list){
                $retval=sendEmail($list,$subject,$message);
                if(!$retval){
                    break;
                }else{
                    updateStatus($db,$list);
                }
            }
        }else{
            echo '';
        }
        if($retval){
            echo '<script>alert("Email Sent!")</script>';
        }else{
            echo '<script>alert("Error")</script>';
        }
    }
?>