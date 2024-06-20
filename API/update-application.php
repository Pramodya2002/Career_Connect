<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header('Location: ./auth.php?error[]=You need to login first');
}

if ($_SESSION['type'] != 'employer') {
    header('Location: ./auth.php?error[]=You are not authorized to access this page');
}

require_once '../utils/db-conn.php';

if (isset($_POST['approve'])) {

    $job_id = $_POST['redirect'];
    $applicant_id = $_POST['approve'];
    $cv_id = $_POST['cv_id'];

    $sql = "UPDATE applications SET status = 'approved' WHERE job_id = ? AND applicant_id = ? AND cv_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $job_id, $applicant_id, $cv_id);
    $stmt->execute();

    header("Location: ../dashboard.php?tab=job&job=$job_id&success[]=Applicant approved successfully");
}

if(isset($_POST['reject'])){

    $job_id = $_POST['redirect'];
    $applicant_id = $_POST['reject'];
    $cv_id = $_POST['cv_id'];

    $sql = "UPDATE applications SET status = 'rejected' WHERE job_id = ? AND applicant_id = ? AND cv_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $job_id, $applicant_id, $cv_id);
    $stmt->execute();


}


?>
