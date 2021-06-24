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

    function displayAllList($db){
        $query ="SELECT * FROM waitlist";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['email'].'"></th>
                    <td>'.$data['name'].'</td>
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
        $headers="From: support@mauisnorkeling.com" . "\r\n" .
                 "CC: support2@mauisnorkeling.com"."\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($email,$subject,$message,$headers);
    }
    function updateStatus($db,$email){
        $query = "UPDATE `waitlist` SET `waitlist_approval_sent`=1 WHERE `email`='$email'";
        $result = mysqli_query($db,$query);
    }
    function getListByEmail($db,$email){
        $query="SELECT * FROM `waitlist` where `email` = '$email'";
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