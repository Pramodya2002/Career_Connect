<?php
function createProfile($path){
    require_once 'file-operations.php';
    createPath($path);
    $profile_image_source = "src/img/" . "default.jpg";
    $profile_image_destination = $path . "profile-image.jpg";

    //echo $profile_image_destination;
    //echo $profile_image_source;

    copyFile($profile_image_source, $profile_image_destination);
}
