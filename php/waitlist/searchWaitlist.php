<?php 
    include '../functions.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $aname=$_GET['aname'];
    $sdate=$_GET['sdate'];
    $edate=$_GET['edate'];
    $query="SELECT * FROM waitlist WHERE waitlist_approval_sent = 0";//where waitlist approval
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if($name == "" && $sdate=="" && $edate=="" && $aname !=""){//activity name alone    1
            if($data['waitlist_activity_name'] == $aname){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate=="" && $edate=="" && $aname !=""){//activity name and search name    2
            if(stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name == "" && $sdate!="" && $edate=="" && $aname !=""){//activity name and start date 3
            if($sdate == $data['waitlist_start_date'] && $aname == $data['waitlist_activity_name']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name == "" && $sdate=="" && $edate!="" && $aname !=""){//activity name and end date   4
            if($edate == $data['waitlist_end_date'] && $aname == $data['waitlist_activity_name']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate!="" && $edate=="" && $aname !=""){//activity name and start date and search name    5
            if(stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name'] && $sdate == $data['waitlist_start_date']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate=="" && $edate!="" && $aname !=""){//activity name and end date and search name   6
            if(stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name'] && $edate == $data['waitlist_end_date']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name == "" && $sdate!="" && $edate=="" && $aname ==""){//sdate  7
            if($sdate == $data['waitlist_start_date']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name == "" && $sdate=="" && $edate!="" && $aname ==""){//edate  8
            if($edate == $data['waitlist_end_date']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate=="" && $edate!="" && $aname ==""){//search name and end date   9
            if($edate == $data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate!="" && $edate=="" && $aname ==""){//search name and start date   10
            if($sdate == $data['waitlist_start_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name == "" && $sdate!="" && $edate!="" && $aname ==""){//sdate and end date   11
            if($sdate <= $data['waitlist_start_date'] && $data['waitlist_end_date'] <= $edate){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name == "" && $sdate!="" && $edate!="" && $aname !=""){//sdate and end date and act   12
            if($sdate <= $data['waitlist_start_date'] && $data['waitlist_end_date'] <= $edate && $aname == $data['waitlist_activity_name']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate!="" && $edate!="" && $aname ==""){//sdate and end date and act   13
            if($sdate <= $data['waitlist_start_date'] && $data['waitlist_end_date'] <= $edate && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if($name != "" && $sdate!="" && $edate!="" && $aname !=""){//sdate and end date and act   13
            if($sdate <= $data['waitlist_start_date'] && $data['waitlist_end_date'] <= $edate && stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name']){
                $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
            }
        }else if(stristr($name,substr($data[$type],0,strlen($name))) && $sdate=="" && $edate=="" && $aname == ""){// search alone 15
            $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
                    <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['waitlist_activity_name'].'</td>
                    <td>'.$data['waitlist_start_date'].'</td>
                    <td>'.$data['waitlist_end_date'].'</td>
                    <td>'.$data['waitlist_num_passengers'].'</td>
                    <td><a href="#" onclick="editList('.$data['waitlist_id'].')" data-toggle="modal" data-target="#waitInfo"><i class="fas fa-edit"></i></a></td>
                </tr>
            ';
        }
    }  
    if($name === "" && $str ==="" && $sdate=="" && $edate=="" && $aname ==""){
        displayAllList($db);
    }else if($str === ""){
        echo  'No Results Found';
    }else{
        echo $str;
    }

?>
