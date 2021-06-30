<?php 
    include '../php/functions.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $query="SELECT * FROM waitlist";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
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
    if($name === "" && $str ===""){
        displayAllList($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
