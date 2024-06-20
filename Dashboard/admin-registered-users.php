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

    require_once 'utils/db-conn.php';

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];

    if($user_type != 'admin'){
        header('Location: ../index.php?error[]=You are not authorized to access this page');
    }

    $sql = "SELECT * FROM applicants WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    echo "<div class='applicant-container'>Applicants</div>";
    if($result->num_rows == 0){
        echo "No Applicants found";
    }else{
        $applicants = $result->fetch_all(MYSQLI_ASSOC);     
        foreach($applicants as $applicant){
            echo "
                    <div class='applicant-container'>
                        <div class='thumb'><img width='100px' height='100px' src='profiles/applicant/".$applicant['user_id']."/profile-image.jpg'></div>
                        <div><span class='aname'>".$applicant['name']."</span><span class='atype'>ID :<span class='auname'>".$applicant['user_id']."</span></span></div>
                        <div class='download'>
                            
                        </div>
                        <div class='desc'></div>
                        <div class='approve'> 
                        </div>
                    </div>";
        }
    }

    $sql = "SELECT * FROM employers WHERE email != 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    echo "<div class='applicant-container'>Employers</div>";

    if($result->num_rows == 0){
        echo "No Employers found";
    }else{
        $employers = $result->fetch_all(MYSQLI_ASSOC);     
        foreach($employers as $employer){
            echo "
                    <div class='applicant-container'>
                        <div class='thumb'></div>
                        <div><span class='aname'>".$employer['company_name']."</span><span class='atype'>ID :<span class='auname'>".$employer['user_id']."</span></span></div>
                        <div class='download'>
                            
                        </div>
                        <div class='desc'></div>
                        <div class='approve'> 
                        </div>
                    </div>";
        }
    }
?>