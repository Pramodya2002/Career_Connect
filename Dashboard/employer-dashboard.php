<?php

if(!isset($DASHBOARD) || !$DASHBOARD == true){
	header('Location: ../dashboard.php');
}

$EDASHBOARD = true;

if (!isset($_SESSION['login']) || !$_SESSION['login'] == true) {
	header('Location: ../auth.php?error[]=You need to login first');
}

if ($_SESSION['type'] != "employer") {
	header("../index.php");
}

require_once "utils/db-conn.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM employers WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
	<link type="text/css" rel="stylesheet" href="../src/css/theme.css">
	<link type="text/css" rel="stylesheet" href="../src/css/main.css">
	<link type="text/css" rel="stylesheet" href="../src/css/navbar.css">
	<link type="text/css" rel="stylesheet" href="../src/css/profile.css">
	<link type="text/css" rel="stylesheet" href="../src/css/applicant-card.css">


	<script src="../src/js/profile.js"></script>
</head>

<body>
	<nav class="navbar-container">
		<?php require_once 'common/navbar.php'; ?>
	</nav>
	<div class="main-container-alt">
		<div class="left-container-alt">
			<nav class="left-nav-alt">
				<ul>
					<li><a href="dashboard.php?tab=profile-settings">Profile Settings</a></li>
				</ul>
				<div class="job-list">
					<div class="job-list_title">My Jobs</div>
					<ul>
						<?php require_once 'employer-my-jobs.php'; ?>
					</ul>
				</div>
			</nav>
		</div>
		<div class="right-container-alt">
			<?php
				if(!isset($_GET['tab']) || $_GET['tab'] == "profile-settings"){
					$_GET['tab'] = "profile-settings";
				}
				
				require_once "dashboard/employer-".$_GET['tab'].".php";

			?>
		</div>
	</div>



</body>

</html>