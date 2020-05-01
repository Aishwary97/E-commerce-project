<?php
$target_dir = "/opt/bitnami/apps/wordpress/htdocs/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["tmp_name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {
        echo "File is valid image.\r\n";
        $uploadOk = 1;
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
           echo "\r\n The file  ".basename( $_FILES["fileToUpload"]["name"])."  has been uploaded.";
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    } 
    else 
    {
        echo "File is not an image.";
        $uploadOk = 0;
    }
        
?>