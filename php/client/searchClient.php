<?php 
    include '../functions.php';
    $name=$_GET['name'];//search
    $type=$_GET['type'];//search Type
    $dnd = $_GET['dnd'];
    $cdate = $_GET['cdate'];
    $query="SELECT * FROM clients WHERE client_enabled = 1";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        $check = $data['client_dnd'] == 1?"checked":"";
        $enable = $data['client_enabled'] == 1?"Active":"Inactive";
        $tdata='
        <tr class="tableItem">
            <th scope="row"><input type="checkbox" name="list[]" value="'.$data['client_id'].'"></th>
            <td><a href="#" onclick="info('.$data['client_id'].')" data-toggle="modal" data-target="#info">'.$data['client_name'].'</a></td>
            <td>'.$data['client_phone'].'</td>
            <td>'.$data['client_email'].'</td>
            <td>'.$data['client_date_created'].'</td>
            <td><input type="checkbox" class="form-check-input" style="margin : 0.4rem 0.5rem;height:15px;width:15px" id="'.$data['client_id'].'" value="'.$data['client_dnd'].'" onclick="updateDND('.$data['client_id'].')" autocomplete="off" '.$check.'></td>
            <td>'.$enable.'</td>
        </tr>
        ';
        if(stristr($name,substr($data[$type],0,strlen($name))) && $dnd=='' && $cdate == ''){//search name
            $str.=$tdata;
        }else if($name == '' && $dnd !='' && $cdate == ''){//dnd
            if($dnd == $data['client_dnd']){
                $str.=$tdata;
            }
        }else if($name == '' && $dnd =='' && $cdate != ''){//cdate
            if($cdate == $data['client_date_created']){
                $str.=$tdata;
            }
        }else if($name == '' && $dnd !='' && $cdate != ''){//cdate and dnd
            if($cdate == $data['client_date_created'] && $dnd == $data['client_dnd'] ){
                $str.=$tdata;
            }
        }else if($name != '' && $dnd =='' && $cdate != ''){//cdate and name
            if(stristr($name,substr($data[$type],0,strlen($name))) && $cdate == $data['client_date_created'] ){
                $str.=$tdata;
            }
        }else if($name != '' && $dnd !='' && $cdate == ''){
            if(stristr($name,substr($data[$type],0,strlen($name))) && $dnd == $data['client_dnd'] ){
                $str.=$tdata;
            }
        }else if($name != '' && $dnd !='' && $cdate != ''){
            if(stristr($name,substr($data[$type],0,strlen($name))) && $dnd == $data['client_dnd'] && $cdate == $data['client_date_created']){
                $str.=$tdata;
            }
        }
    }  
    if($name === "" && $str ==="" && $cdate == "" && $dnd == ''){
        displayAllClients($db);
    }
    echo $str ==""? 'No Results Found':$str;

?>
