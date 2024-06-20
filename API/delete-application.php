<?php

session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header('Location: ./auth.php?error[]=You need to login first');
}

if ($_SESSION['type'] != 'applicant') {
    header('Location: ./auth.php?error[]=You are not authorized to access this page');
}

require_once '../utils/db-conn.php';

if (isset($_POST['delete'])) {

    $job_id = $_POST['job_id'];
    $applicant_id = $_SESSION['user_id'];
    $cv_id = $_POST['delete'];

    $sql = "DELETE FROM applications WHERE job_id = ? AND applicant_id = ? AND cv_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $job_id, $applicant_id, $cv_id);
    $stmt->execute();

    header("Location: ../dashboard.php?tab=my-applications&success[]=Application deleted successfully");
}
?>