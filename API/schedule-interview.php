<?php

    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
        header('Location: ./auth.php?error[]=You need to login first');
    }

    if ($_SESSION['type'] != 'employer') {
        header('Location: ./auth.php?error[]=You are not authorized to access this page');
    }

    if(isset($_POST['interview'])){
        require_once '../utils/db-conn.php';

        $employer_id = $_SESSION['user_id'];
        $applicant_id = $_POST['interview'];
        $job_id = $_POST['redirect'];
        $cv_id = $_POST['cv_id'];
        $date = $_POST['date'];

        echo "Employer ID: $employer_id <br>";
        echo "Applicant ID: $applicant_id <br>";
        echo "Job ID: $job_id <br>";
        echo "Date: $date <br>";

        $sql = "INSERT INTO interviews (job_id, applicant_id,cv_id, employer_id, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $job_id, $applicant_id, $cv_id, $employer_id, $date);
        $stmt->execute();

        $sql = "UPDATE applications SET status = 'interview' WHERE job_id = ? AND applicant_id = ? AND cv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $job_id, $applicant_id, $cv_id);
        $stmt->execute();

        header("Location: ../dashboard.php?tab=job&job=$job_id&success[]=Interview scheduled successfully");

    }
?>