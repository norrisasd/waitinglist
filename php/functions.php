<?php
    $host="localhost";
    $user="root";
    $pass="";
    $data="waitlist";
    $db = mysqli_connect($host,$user,$pass,$data);
        //local
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
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

    function displayAllList($db){
        $query ="SELECT * FROM list";
        $result=mysqli_query($db,$query);
        if($result){
            while($data = mysqli_fetch_assoc($result)){
                echo'
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['email'].'"></th>
                    <td>'.$data['name'].'</td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['service'].'</td>
                </tr>
                ';
            }
        }
    }
    if(isset($_POST['sendEmail'])){
        if(!empty($_POST['list'])){
            foreach($_POST['list'] as $list){
                echo '<script>alert("'.$list.'")</script>';//mailing 
            }
        }else{
            echo '';
        }
    }
?>