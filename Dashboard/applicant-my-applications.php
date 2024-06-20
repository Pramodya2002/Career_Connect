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

    if($user_type != 'applicant'){
        header('Location: ../index.php');
    }

    $sql = "SELECT * FROM applications WHERE applicant_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 0){
        echo "You have not applied to any jobs yet";
    }else{
        $user_applications = $result->fetch_all(MYSQLI_ASSOC);

        foreach($user_applications as $application){
            $sql = "SELECT * FROM jobs WHERE job_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $application['job_id']);
            $stmt->execute();

            $result = $stmt->get_result();
            $job = $result->fetch_assoc();

            $sql = "SELECT * FROM employers WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $job['employer_id']);
            $stmt->execute();

            $result = $stmt->get_result();
            $employer = $result->fetch_assoc();

            echo "
                    <div class='applicant-container' id='".$job['title']."'>
                        <div class='thumb'><img width='100px' height='100px' src='profiles/applicant/".$application['applicant_id']."/cvs/".$application['cv_id'].".jpg'></div>
                        <div><span class='aname'>".$job['title']."</span><span class='atype'>Company :<span class='auname'>".$employer['company_name']."</span></span></div>
                        <div class='download'>
                            <div class='status-indicator-container ".$application['status']."'>
                                <span class='status-indicator ".$application['status']."'></span>
                                <span class='status-text'>".$application['status']."</span>
                            </div>
                        </div>
                        <div class='desc'>".$application['date']."</div>
                        <div class='approve'> 

                        </div>";
                        if($application['status'] == "pending"){
                            echo "
                        <div class='reject'>
                            <form method='POST' action='../api/delete-application.php'>
                            <input type='hidden' name='job_id' value='".$application['job_id']."'>
                            <button value='".$application['cv_id']."' class='button' name='delete' type='submit'><span class='material-symbols-outlined'>
                            close</span><span class='text'>Cancel</span>
                                </button>
                        </form>
                        </div>";}
                    echo "</div>";
        }
    }
?>