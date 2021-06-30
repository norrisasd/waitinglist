<?php 
    include '../php/functions.php';
    $name=$_GET['name'];//search
    $type=$_GET['type'];//search Type
    $query="SELECT * FROM clients";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $str.='
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
    if($name === "" && $str ===""){
        displayAllClients($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
