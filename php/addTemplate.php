<?php
    require 'conn.php';
    if(isset($_POST['addTemplate'])){
        $name = $_POST['TemplateName'];
        $subject =$_POST['subject'];
        $text = $_POST['message'];
        $query="INSERT INTO `emailtemplates`(`TemplateName`, `subject`, `message`) VALUES ('$name','$subject','$text')";
        $result=mysqli_query($db,$query);
        if($result){
            echo '<script>alert("success");
                  window.location="../pages/emailtemplates.php";
            </script>';
            
        }else{
            echo mysqli_error($db);
        };
    }
?>