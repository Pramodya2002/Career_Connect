<?php
session_start();
require_once 'Utils/db-conn.php';

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
  //echo "You are logged in as ".$_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>CAREER CONNECT</title>
  <link rel="stylesheet" type="text/css" href="src/css/footer.css">
  <link rel="stylesheet" type="text/css" href="src/css/theme.css">
  <link rel="stylesheet" type="text/css" href="src/css/main.css">
  <link rel="stylesheet" type="text/css" href="src/css/home.css">
  <link rel="stylesheet" type="text/css" href="src/css/navbar.css">
 

  <script src="src/js/error.js"></script>
</head>

<body>
    

  <nav class="navbar-container">
    <?php require_once 'common/navbar.php'; ?>
  </nav>

  <div class="container">

    <div class="hero">
    <img src="./src/img/logo.png" class="logo-image" alt="Career Connect Logo">
      <div class="hero-text">
        <h1><span>Welcome to</span> <br>
        <h2>Career Connect</h2>
        <p>Connecting job seekers and employers for a brighter future.</p>
        </h1>
      </div>
    </div>

    <div class="Row">
      <div class="column-1">
        <div class="card">
          <h3>For Job Seekers</h3>
          <p>Explore diverse job listings tailored to your skills<br>
            Apply for jobs and track your application status<br>
            Access resources to improve your resume and interview skills.</p>
        </div>
      </div>

      <div class="column-2">
        <div class="card">
          <h3>For Employers</h3>
          <p>Post job openings and reach qualified candidates<br>
            Manage your job listings and applications<br>
            Discover tools to enhance your recruitment process.</p>
        </div>
      </div>
    </div>

  </div>
  <div class="counts">
    <div class="count-element">
      <h1>200+</h1>
      <span>Companies</span>
    </div>
    <div class="count-element">
      <h1>5000+</h1>
      <span>Careers</span>
    </div>
    <div class="count-element">
      <h1>1500+</h1>
      <span>Success Stories</span>
    </div>
  </div>

  </div>

  <div class="footer">
  <?php require_once 'common/footer.php'; ?>
  </div>
  </div>

  <div class="error-container" id="error-container">
        <?php
        if (isset($_GET['error'])) {
            $errors = $_GET['error'];

            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
        }
        if (isset($_GET['success'])) {
            $successes = $_GET['success'];

            foreach ($successes as $success) {
                echo "<p class='success'>$success</p>";
            }
        }
        ?>
    </div>

   

</body>
</html>