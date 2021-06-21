<?php
$host="localhost";
$user="root";
$pass="";
$data="waitlist";
$db = mysqli_connect($host,$user,$pass,$data);
    //local
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
    if(isset($_POST['addTemplate'])){
        $name = $_POST['TemplateName'];
        $email = "wew";
        $subject =$_POST['subject'];
        $text = $_POST['message'];
        
        $query="INSERT INTO `emailtemplates`(`TemplateName`,`email`, `subject`, `message`) VALUES ('$name','$email','$subject','$text')";
        $result=mysqli_query($db,$query);
        if($result){
            echo '<script>alert("success");
                  window.location="../pages/widgets.php";
            </script>';
            
        }else{
            echo mysqli_error($db);
        };
    }
?>