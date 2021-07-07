<?php
    require '../functions.php';
        $name = $_POST['TemplateName'];
        $subject =$_POST['subject'];
        $text = $_POST['message'];
        $query="INSERT INTO `emailtemplates`(`TemplateName`, `subject`, `message`) VALUES ('$name','$subject','$text')";
        $result=mysqli_query($db,$query);
        if($result){
            echo 'Success';
            
        }else{
            echo mysqli_error($db);
        };
?>