<?php
    require 'conn.php';
    if(isset($_POST['addTemplate'])){
        $name = $_POST['TemplateName'];
        $email = "wew";
        $subject =$_POST['subject'];
        $text = $_POST['message'];
        
        $query="INSERT INTO `emailtemplates`(`TemplateName`,`email`, `subject`, `message`) VALUES ('$name','$email','$subject','$text')";
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