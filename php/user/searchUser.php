<?php 
    include '../functions.php';
    $name=$_GET['name'];//search
    $type=$_GET['type'];//search Type
    $query="SELECT * FROM user";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
                $str.='
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['username'].'"></th>
                    <td><a href="#" onclick="info(\''.$data['username'].'\')" data-toggle="modal" data-target="#info">'.$data['username'].'</a></td>
                    <td>'.$data['email'].'</td>';
                    if($data['isAdmin']== 0 ){
                       $str.= '<td>False</td>
                        <td><a href="#" onclick="makeAdmin(\''.$data['username'].'\')">Grant Access</a></td>';
                    }else{
                        $str.= '<td>True</td>
                            <td><a href="#" onclick="removeAdmin(\''.$data['username'].'\')">Remove Access</a></td>';
                    }
                    
                $str.= '</tr>
                ';
        }
    }  
    if($name === "" && $str ===""){
        displayAllUser($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
