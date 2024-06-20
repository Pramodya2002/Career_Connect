<?php
function createPath($path){
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
}

function copyFile($source, $destination){
    if (!copy($source, $destination)) {
        return false;
    }
}

function deleteFile($path){
    if (!unlink($path)) {
        return false;
    }
    return true;
}

function uploadImage($path,$file_name, $file, $redirect)
{
    $target_dir = $path;
    $target_file = $target_dir . basename($file_name);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    echo "<script>console.log('$target_file')</script>";

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>console.log('fake image')</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 5000000) {
        $uploadOk = 0;
        echo "<script>console.log('big file')</script>";
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "<script>console.log('invalid type')</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header("Location: ../$redirect&error[]=There was an error uploading your file");
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            header("Location: ../$redirect&success[]=Image uploaded successfully");
            return $target_file;
        } else {
            header("Location: ../$redirect&error[]=There was an error uploading your file");
            return false;
        }
    }
}

function uploadFile($path,$file_name, $file, $redirect)
{
    $target_dir = $path;
    $target_file = $target_dir . basename($file_name);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    echo "<script>console.log('$target_file')</script>";

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>console.log('fake image')</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 5000000) {
        $uploadOk = 0;
        echo "<script>console.log('big file')</script>";
    }

    if ($uploadOk == 0) {
        
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}
?>