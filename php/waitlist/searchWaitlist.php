<?php 
    include '../functions.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $aname=$_GET['aname'];
    $sdate=$_GET['sdate'];
    $edate=$_GET['edate'];
    $bsdate=$_GET['startDate'];//for between sdate and edate
    $bedate=$_GET['endDate'];
    $displayType=$_GET['displayType'];
    $dateCreated = $_GET['dateCreated'];
    $passengers=$_GET['passengers'];
    $passengers=$passengers==''?'':'AND waitlist_num_passengers='.$passengers.'';
    $bcheck = $bsdate == '' && $bedate =='';
    if($displayType == "" && $dateCreated =="" ){
        $query="SELECT * FROM waitlist WHERE waitlist_enabled = 1 $passengers";
    }else if($displayType !="" && $dateCreated == ""){
        $query="SELECT * FROM waitlist WHERE waitlist_approval_sent = $displayType AND waitlist_enabled = 1 $passengers";
    }else if($displayType =="" && $dateCreated !=""){
        $query="SELECT * FROM waitlist WHERE waitlist_date_created = '$dateCreated' AND waitlist_enabled = 1 $passengers";
    }else{
        $query="SELECT * FROM waitlist WHERE waitlist_date_created = '$dateCreated' AND waitlist_approval_sent = $displayType AND waitlist_enabled = 1 $passengers";
    }
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        $text ='
        <tr class="tableItem" style="color:gray">
            <th scope="row"><input type="checkbox" name="list[]" value=""><input type="checkbox" name="waitlist_id[]" value="'.$data['waitlist_id'].'" style="display:none;"></th>
            <td><a href="#" onclick="info('.$data['waitlist_id'].')" data-toggle="modal" data-target="#info">'.$data['name'].'</a></td>
            <td>'.$data['phone'].'</td>
            <td>'.$data['email'].'</td>
            <td>'.$data['waitlist_activity_name'].'</td>
            <td>'.$data['waitlist_date_created'].'</td>
            <td>'.$data['waitlist_start_date'].'</td>
            <td>'.$data['waitlist_end_date'].'</td>
            <td>'.$data['waitlist_num_passengers'].'</td>
        </tr>
        ';
        if($bcheck && $name == "" && $sdate=="" && $edate=="" && $aname !=""){//activity name alone    1
            if($data['waitlist_activity_name'] == $aname){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate=="" && $edate=="" && $aname !=""){//activity name and search name    2
            if(stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if($bcheck && $name == "" && $sdate!="" && $edate=="" && $aname !=""){//activity name and start date 3
            if($sdate == $data['waitlist_start_date'] && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if($bcheck && $name == "" && $sdate=="" && $edate!="" && $aname !=""){//activity name and end date   4
            if($edate == $data['waitlist_end_date'] && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate!="" && $edate=="" && $aname !=""){//activity name and start date and search name    5
            if(stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name'] && $sdate == $data['waitlist_start_date']){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate=="" && $edate!="" && $aname !=""){//activity name and end date and search name   6
            if(stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name'] && $edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if($bcheck && $name == "" && $sdate!="" && $edate=="" && $aname ==""){//sdate  7
            if($sdate == $data['waitlist_start_date']){
                $str.=$text;
            }
        }else if($bcheck && $name == "" && $sdate=="" && $edate!="" && $aname ==""){//edate  8
            if($edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate=="" && $edate!="" && $aname ==""){//search name and end date   9
            if($edate == $data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate!="" && $edate=="" && $aname ==""){//search name and start date   10
            if($sdate == $data['waitlist_start_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.=$text;
            }
        }else if($bcheck && $name == "" && $sdate!="" && $edate!="" && $aname ==""){//sdate and end date   11
            if($sdate == $data['waitlist_start_date'] && $data['waitlist_end_date'] == $edate){
                $str.=$text;
            }
        }else if($bcheck && $name == "" && $sdate!="" && $edate!="" && $aname !=""){//sdate and end date and act   12
            if($sdate == $data['waitlist_start_date'] && $data['waitlist_end_date'] == $edate && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate!="" && $edate!="" && $aname ==""){//sdate and end date and act   13
            if($sdate == $data['waitlist_start_date'] && $data['waitlist_end_date'] == $edate && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.=$text;
            }
        }else if($bcheck && $name != "" && $sdate!="" && $edate!="" && $aname !=""){//sdate and end date and act   14
            if($sdate == $data['waitlist_start_date'] && $data['waitlist_end_date'] == $edate && stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate=="" && $edate=="" && $aname ==""){// between alone
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate=="" && $edate=="" && $aname ==""){// between name
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate!="" && $edate=="" && $aname ==""){// between sdate
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $sdate == $data['waitlist_start_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate=="" && $edate!="" && $aname ==""){// between edate
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate=="" && $edate=="" && $aname !=""){// between act d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate!="" && $edate=="" && $aname !=""){// between act sdate d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $sdate == $data['waitlist_start_date'] && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate=="" && $edate!="" && $aname !=""){// between act edate d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $edate == $data['waitlist_end_date'] && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate=="" && $edate=="" && $aname !=""){// between act name d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name))) && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate=="" && $edate!="" && $aname !=""){// between sdate edate d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $sdate == $data['waitlist_start_date'] && $edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate!="" && $edate=="" && $aname ==""){// between sdate name d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $sdate == $data['waitlist_start_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate=="" && $edate!="" && $aname ==""){// between edate name d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $edate == $data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate!="" && $edate=="" && $aname !=""){// between name act sdate d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))&& $aname == $data['waitlist_activity_name'] && $sdate == $data['waitlist_start_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate=="" && $edate!="" && $aname !=""){// between name act edate  d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))&& $aname == $data['waitlist_activity_name'] && $edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name == "" && $sdate!="" && $edate!="" && $aname !=""){//between act sdate edate  d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && $sdate == $data['waitlist_start_date'] && $aname == $data['waitlist_activity_name'] && $edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate!="" && $edate!="" && $aname ==""){// between sdate name edate d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))&& $sdate == $data['waitlist_start_date'] && $edate == $data['waitlist_end_date']){
                $str.=$text;
            }
        }else if(!$bcheck && $name != "" && $sdate!="" && $edate!="" && $aname !=""){// between name act sdate edate d
            if($bsdate <= $data['waitlist_start_date'] && $bedate>=$data['waitlist_end_date'] && stristr($name,substr($data[$type],0,strlen($name)))&& $sdate == $data['waitlist_start_date'] && $edate == $data['waitlist_end_date'] && $aname == $data['waitlist_activity_name']){
                $str.=$text;
            }
        }else if(stristr($name,substr($data[$type],0,strlen($name))) && $sdate=="" && $edate=="" && $aname == ""){// search alone 15
            $str.=$text;
        }else if($passengers != ""){
            $str.=$text;
        }
    }  
    if($name == "" && $str =="" && $sdate=="" && $edate=="" && $aname =="" && $bcheck && $passengers=="" ){
        displayAllList($db,$displayType,$dateCreated);
    }else{
        echo $str;
    }

?>
