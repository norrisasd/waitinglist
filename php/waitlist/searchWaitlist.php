<?php 
    include '../functions.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $query="SELECT * FROM waitlist WHERE waitlist_approval_sent = 0";//where waitlist approval
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
        }
    }  
    if($name === "" && $str ===""){
        displayAllList($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
