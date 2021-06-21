<?php 
    include '../php/functions.php';
    // $host="localhost";
    // $user="root";
    // $pass="";
    // $data="waitlist";
    // $db = mysqli_connect($host,$user,$pass,$data);
    //     //local
    // if (!$db) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }
    require 'conn.php';
    $name=$_GET['name'];
    $type=$_GET['type'];
    $query="SELECT * FROM list";
    $result=mysqli_query($db,$query);
    $str="";
    while($data=mysqli_fetch_assoc($result)){
        if(stristr($name,substr($data[$type],0,strlen($name)))){
            $str.='
                <tr>
                    <th scope="row"><input type="checkbox" name="list[]" value=""></th>
                    <td>'.$data['name'].'</td>
                    <td>'.$data['phone'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['service'].'</td>
                </tr>
            ';

        }
    }  
    if($name === "" && $str ===""){
        displayAllList($db);
    }
    echo $str === "" && $name !=""? 'No Results Found':$str;

?>
