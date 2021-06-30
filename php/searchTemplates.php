<?php 
    include '../php/functions.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $query="SELECT * FROM emailtemplates";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""></th>
                    <td>'.$data['TemplateName'].'</td>
                    <td>'.$data['subject'].'</td>
                    <td>'.$data['message'].'</td>
                </tr>
            ';
        }
    }  
    if($name === "" && $str ===""){
        displayAllTemplates($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
