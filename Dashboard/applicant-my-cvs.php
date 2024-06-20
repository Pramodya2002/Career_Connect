<div class="content-box"> Upload New CV <br />

    <div class="profile-img-container">

        <form action="api/new-cv.php" method="POST" class="flex-row" enctype="multipart/form-data">
            <label class="image-upload" id="profile-image">
                <input type="file" name="image" id="image" class="image-upload__input" accept="image/*" required>
                <div class="image-upload__preview" style="background-image:url(src/img/default-cv.jpg)"></div>
                <div class="image-upload__path">Choose File</div>

            </label>
            <input type="text" name="cv_name" class="in-t3 in-t2" placeholder="CV Name" required>
            <input type="hidden" name="redirect" value="dashboard.php?tab=my-cvs">
            <button value='submit' class='button green' name='submit' type='submit'><span class='material-symbols-outlined'>
                    check</span><span class='text'>Upload</span>
            </button>
        </form>
    </div>
</div>

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth.php?error[]=You need to login first');
}

if(!isset($DASHBOARD) || !$DASHBOARD == true){
	header('Location: ../dashboard.php');
}

require_once 'utils/db-conn.php';

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['type'];

if ($user_type != 'applicant') {
    header('Location: ../index.php?error[]=You are not authorized to access this page');
}

$sql = "SELECT * FROM cvs WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<div class='content-box'>You do not have any CVs uploaded yet. Upload a CV</div>";
} else {
    $user_cvs = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($user_cvs as $cv) {
        $sql = "SELECT * FROM applications WHERE cv_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cv['cv_id']);
        $stmt->execute();

        $application_r = $stmt->get_result();
        $applications = $application_r->fetch_all(MYSQLI_ASSOC);

        echo "
                    <div class='applicant-container'>
                        <div class='thumb'><img width='100px' height='100px' src='profiles/applicant/" . $user_id . "/cvs/" . $cv['cv_id'] . ".jpg'></div>
                        <div><span class='aname'>" . $cv['name'] . "</span><span class='atype'>ID :<span class='auname'>" . $cv['cv_id'] . "</span></span></div>";
        if ($application_r->num_rows == 0) {
            echo "<div class='reject'>
                            <form method='POST' action='api/delete-cv.php'>
                            <button value='" . $cv['cv_id'] . "' class='button' name='delete' type='submit'><span class='material-symbols-outlined'>
                            delete</span><span class='text'>Delete</span>
                                </button>
                        </form>
                        </div>";
        }
        echo "<div class='desc'> <span class='atype'><span class='auname'>Applied Jobs</span></span><br/><ul>";
        if($application_r->num_rows == 0){
            echo "<li class='job'>You have not applied to any jobs using this CV yet</li><br/>";
        }
        foreach ($applications as $application) {
            $sql = "SELECT * FROM jobs WHERE job_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $application['job_id']);
            $stmt->execute();

            $job_result = $stmt->get_result();
            $job = $job_result->fetch_assoc();
            echo "<li class='job'><a class='default' href='dashboard.php?tab=my-applications#".$job['title']."'>" . $job['title'] . "</a></li><br/>";
        }

        echo "</ul></div></div>";
    }
}
?>