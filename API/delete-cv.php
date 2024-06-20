<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.php?error[]=You need to login first");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SESSION['type'] != 'applicant') {
    header("Location: ../auth.php?error[]=You are not authorized to access this page");
    exit();
}

if (isset($_POST['delete'])) {

    $cv_id = $_POST['delete'];

    require_once '../utils/db-conn.php';

    require_once '../utils/file-operations.php';

    $deleted = deleteFile("../profiles/applicant/$user_id/cvs/$cv_id.jpg");

    $sql = "DELETE FROM cvs WHERE user_id = ? AND cv_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_id, $cv_id);
    $stmt->execute();

    echo "DELETE FROM cvs WHERE user_id = $user_id AND cv_id = $cv_id";
    header("Location: ../dashboard.php?tab=my-cvs&success[]=CV deleted successfully");
    exit();
}
?>