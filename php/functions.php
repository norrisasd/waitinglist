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
                 "CC: support@mauisnorkeling.com"."\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($email,$subject,$message,$headers);
    }
    if(isset($_POST['sendEmail'])){
        $subject=$_POST['subject1'];
        $message=$_POST['text1'];
        if(!empty($_POST['list'])){
            foreach($_POST['list'] as $list){
                $retval=sendEmail($list,$subject,$message);
                if(!$retval){
                    break;
                }
            }
        }else{
            echo '';
        }
        if($retval){
            echo '<script>alert("Email Sent!")</script>';
        }else{
            echo '<script>alert("'.mysqli_error($db).'")</script>';
        }
    }
?>