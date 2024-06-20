<?php
require 'utils/db-conn.php';

session_start();

if(!isset($_SESSION['login']) || !$_SESSION['login'] == true || $_SESSION['type'] != 'applicant' || !isset($_SESSION['user_id'])){
    header('Location: ./auth.php?error[]=You need to login first');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $application_date = $_POST['application_date'];

    $sql = "INSERT INTO applications (job_id, applicant_id, cv_id, date, status) VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $job_id, $_SESSION['user_id'], $_POST['cv_id'], $application_date);
    $stmt->execute();

    header("Location: ./dashboard.php?tab=my-applications");
}

$conn->close();
