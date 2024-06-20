<?php
require 'db-conn.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$redirect = $_POST['redirect'];

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.php?error[]=You need to login first");
}

$user_id = $_SESSION['user_id'];

$path = "../profiles/".$_SESSION['type']."/$user_id/cvs/";

require_once 'file-operations.php';
createPath($path);

$uploaded = uploadFile($path, $cv_id.".jpg", $_FILES['image'], $redirect);
