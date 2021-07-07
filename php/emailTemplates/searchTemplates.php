<?php 
    include '../functions.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $query="SELECT * FROM emailtemplates";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $str.='
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
    if($name === "" && $str ===""){
        displayAllTemplates($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
