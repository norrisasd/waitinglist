<?php
    require '../functions.php';
        #retrieve file title
    $title = $_POST["title"];
    
    #file name with a random number so that similar dont get replaced
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];// use if needed uniqname

    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
    $img_size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    #upload directory path
    $uploads_dir = '../../dist/img';
    #TO move the uploaded file to specific location
    if($error == 0){
        if ($img_size > 1250000) {
			echo "Sorry, your file is too large.";
		}else{
            move_uploaded_file($tname, $uploads_dir.'/'.$title);
            $user = $_SESSION['username'];
            $sql = "UPDATE `user` SET `image_file`='$title' WHERE `username`='$user'";
            if(mysqli_query($db,$sql)){

                echo "File Sucessfully uploaded";
                $_SESSION['img']=$title;
            }
            else{
                echo mysqli_error($db);
            }
        }
    }else{
        echo 'Error!';
    }
    

    #sql query to insert into database
    

    
    
?>