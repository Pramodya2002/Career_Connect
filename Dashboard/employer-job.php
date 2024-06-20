<?php
if (!isset($EDASHBOARD)) {
    header('Location: ../dashboard.php?tab=profile-settings');
}

$job_id = $_GET['job'];

$sql = "SELECT * FROM jobs WHERE job_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $job_id);
$stmt->execute();

$job = $stmt->get_result()->fetch_assoc();

if ($job['employer_id'] != $user_id) {
    header('Location: ../dashboard.php?tab=profile-settings');
}

$sql = "SELECT * FROM applications WHERE job_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $job_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "You have not received any applications for this job yet";
} else {
    $job_applications = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($job_applications as $application) {
        $sql = "SELECT * FROM applicants WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $application['applicant_id']);
        $stmt->execute();

        $applicant = $stmt->get_result()->fetch_assoc();

        echo "
                    <div class='applicant-container more'>
                        <div class='thumb'><img width='100px' height='100px' src='profiles/applicant/" . $applicant['user_id'] . "/profile-image.jpg'></div>
                        <div><span class='aname'>" . $applicant['name'] . "</span><span class='atype'>User Name :<span class='auname'>" . $applicant['user_name'] . "</span></span></div>
                        ";
        if ($application['status'] == "pending") {
            echo "<div class='approve colspan-2'> 
                                <form class='align-center' method='POST' action='../api/schedule-interview.php'>
                                    <input class='in-t2 in-t2-1' type='datetime-local' name='date' required>
                                    <input type='hidden' name='cv_id' value='" . $application['cv_id'] . "'>
                                    <input type='hidden' name='redirect' value='" . $_GET['job'] . "'>
                                    <button value='" . $applicant['user_id'] . "' class='button' name='interview' type='submit'><span class='material-symbols-outlined'>check</span><span class='text'>Interview</span></button>
                                </form>
                            </div>";
        } elseif ($application['status'] == "interview") {
            echo "<div class='approve colspan-2'> 
                    <form class='align-center' method='POST' action='../api/update-application.php'>
                        <input type='hidden' name='redirect' value='" . $_GET['job'] . "'>
                        <input type='hidden' name='cv_id' value='" . $application['cv_id'] . "'>
                        <button value='" . $applicant['user_id'] . "' class='button' name='approve' type='submit'><span class='material-symbols-outlined'>check</span><span class='text'>Approve</span></button>
                    </form>
                </div>";
        } elseif ($application['status'] == "approved") {
            echo "<div class='approve colspan-2 align-center'> 
                                    <div value='" . $applicant['user_id'] . "' class='button green'>
                                        <span class='material-symbols-outlined'>check</span><span class='text'>Approved</span>
                                    </div>
                                </div>";
        } elseif ($application['status'] == "rejected") {
            echo "<div class='approve colspan-2 align-center'> 
                                    <div value='" . $applicant['user_id'] . "' class='button red'>
                                        <span class='material-symbols-outlined'>close</span><span class='text'>Rejected</span>
                                    </div>                           
                                </div>";
        }

        echo "
                        <div class='download'>
                            <a style='display:inline' href='../profiles/applicant/".$applicant['user_id']."/cvs/".$application['cv_id'].".jpg' download='".$applicant['name']."-".$applicant['user_id'].".jpg'>
                                <button class='button blue' name='download' type='submit'>
                                    <span class='material-symbols-outlined'>download</span><span class='text' style='font-size:11px'>Download CV</span>
                                </button>
                            </a>
                        </div>                        
                        <div class='desc'>" . $applicant['name']; 
                        if ($application['status'] == "pending") {
                            echo " has applied for this job and is waiting for your response";
                        } elseif ($application['status'] == "interview") {
                            echo " has been scheduled for an interview at - <br/>";
                            $sql = "SELECT * FROM interviews WHERE cv_id = ? AND job_id = ? AND applicant_id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $application['cv_id'], $job_id, $applicant['user_id']);

                            $stmt->execute();

                            $interview = $stmt->get_result()->fetch_assoc();

                            echo date('d M Y, h:i A', strtotime($interview['date']));
                            

                        } elseif ($application['status'] == "approved") {
                            echo " has been approved for this job";
                        } elseif ($application['status'] == "rejected") {
                            echo " has been rejected for this job";
                        }
                        echo "</div>";
        if (!($application['status'] == "approved" || $application['status'] == "rejected")) {
            echo "<div class='reject'>
                            <form method='POST' action='../api/update-application.php'>
                            <input type='hidden' name='redirect' value='" . $_GET['job'] . "'>
                            <input type='hidden' name='cv_id' value='" . $application['cv_id'] . "'>
                            <button value='" . $applicant['user_id'] . "' class='button' name='reject' type='submit'><span class='material-symbols-outlined'>
                            close</span><span class='text'>Reject</span>
                                </button>
                        </form>
                        </div>";
        }
        echo  "</div>";
    }
}
