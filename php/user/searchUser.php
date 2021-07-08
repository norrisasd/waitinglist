<?php 
    include '../functions.php';
    $name=$_GET['name'];//search
    $type=$_GET['type'];//search Type
    $query="SELECT * FROM user";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
                $access= $data['isAdmin']==NULL?"FALSE":"TRUE";
                $edit=$data['isAdmin']==1 ?'':'';
                $str.='
                <tr class="tableItem">
                    <th scope="row"><input type="checkbox" name="list[]" value="'.$data['username'].'"></th>';
                    if($_SESSION['access']==1){
                        $str.='<td><a href="#" onclick="info(\''.$data['username'].'\')" data-toggle="modal" data-target="#info">'.$data['username'].'</a></td>';
                    }else{
                        $str.= '<td>'.$data['username'].'</td>';
                    }
                $str.= '<td>'.$data['email'].'</td>
                    <td>'.$access.'</td>';
                    if($_SESSION['access'] == 1){
                        if($data['isAdmin']== NULL ){
                            $str.= '
                             <td><a href="#" onclick="makeAdmin(\''.$data['username'].'\')">Grant Access</a></td>';
                         }else if($data['isAdmin'] == 0){
                             $str.= '
                             <td><a href="#" onclick="removeAdmin(\''.$data['username'].'\')">Remove Access</a></td>';
                         }else{
                            $str.= '<td></td>';
                         }
                         $str.= '<td><a href="#" onclick="editUser(\''.$data['username'].'\')" data-toggle="modal" data-target="#userInfo"><i class="fas fa-edit"></i></a></td>';
                    }else{
                        $str.='<td></td>';
                    }
                $str.= $edit .'
                </tr>
                ';
        }
    }  
    if($name === "" && $str ===""){
        displayAllUser($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
