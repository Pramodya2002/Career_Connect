<?php
    session_start();

    require_once '../utils/db-conn.php';

    if(!isset($_SESSION['user_id'])){
        header('Location: ../auth.php?error[]=You need to login first');
    }

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];

    if($user_type == 'applicant'){
        require_once 'update-applicant.php';

        updateApplicant($conn, $user_id);
    }else if($user_type == 'employer'){
        require_once 'update-employer.php';
        updateEmployer($conn, $user_id);
    }else{
        echo 'Invalid user type';
    }

    header('Location: ../dashboard.php');
?>