<?php
require 'db-conn.php';

session_start();

$redirect = $_GET['redirect'];

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.php?error[]=You need to login first");
}

$user_id = $_SESSION['user_id'];

$path = "../profiles/".$_SESSION['type']."/$user_id/";

require_once 'file-operations.php';
createPath($path);

uploadImage($path,"profile-image.jpg" ,$_FILES['image'], $redirect);
