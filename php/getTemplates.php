<?php 
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
    $tempName =$_GET['tempName'];
    $query ="SELECT * FROM emailtemplates WHERE TemplateName = '$tempName'";
    $result=mysqli_query($db,$query);
    $data = mysqli_fetch_assoc($result);
    echo '
         document.getElementById("subject1").value="'.$data['subject'].'";
         document.getElementById("text1").value="'.$data['message'].'";
         ';
?>