<?php 
    include '../functions.php';
    $name=$_GET['name'];//search
    $type=$_GET['type'];//search Type
    $query="SELECT * FROM clients";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $check = $data['client_dnd'] == 1?"checked":"";
            $enable = $data['client_enabled'] == 1?"Disabled":"Enabled";
            $str.='
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
    if($name === "" && $str ===""){
        displayAllClients($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
