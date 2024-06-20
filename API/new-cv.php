<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.php?error[]=You need to login first");
}

$user_id = $_SESSION['user_id'];

if ($_SESSION['type'] != 'applicant') {
    header("Location: ../auth.php?error[]=You are not authorized to access this page");
}

if (isset($_POST['submit'])) {
    require_once '../utils/gen-id.php';
    require_once '../utils/db-conn.php';

    $cv_id = generateID('c');
    $cv_name = $_POST['cv_name'];

    require_once '../utils/cv-upload.php';

    if($uploaded == false){
        header("Location: ../dashboard.php?tab=new-cv&error[]=Failed to upload CV");
        exit();
    }   
    
    $sql = "INSERT INTO cvs (user_id, cv_id, name) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user_id, $cv_id, $cv_name);
    $stmt->execute();

    header("Location: ../dashboard.php?tab=my-cvs&success[]=CV uploaded successfully");
}
?>