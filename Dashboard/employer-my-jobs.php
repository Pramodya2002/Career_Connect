<?php

if(!isset($DASHBOARD) || !$DASHBOARD == true){
	header('Location: ../dashboard.php');
}
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['user_id'])){
        header('Location: ../auth.php?error[]=You need to login first');
    }



    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];

    if($user_type != 'employer'){
        header('Location: ../index.php');
    }

    require_once 'Utils/db-conn.php';

    $sql = "SELECT * FROM jobs WHERE employer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 0){
        echo "You have not created any jobs yet";
    }else{
        $company_jobs = $result->fetch_all(MYSQLI_ASSOC);
        foreach($company_jobs as $job){
            echo "<li><a href=dashboard.php?tab=job&job=".$job['job_id'].">".$job['title']."</a></li>";
        }
    }

?>