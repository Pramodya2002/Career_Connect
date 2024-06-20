<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>About Us</title>
  <link rel="stylesheet" type="text/css" href="src/css/theme.css">
  <link rel="stylesheet" type="text/css" href="src/css/main.css">
  <link rel="stylesheet" type="text/css" href="src/css/home.css">
  <link rel="stylesheet" type="text/css" href="src/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="src/css/aboutus.css">
  <link rel="stylesheet" type="text/css" href="src/css/footer.css">

  <script src="src/js/jquery-3.7.1.min.js"></script>
    <script src="src/js/error.js"></script>
</head>

<body>
  <nav class="navbar-container">
    <?php require_once 'common/navbar.php'; ?>
  </nav>
  <br>
  <br>
  <div class="hero">
      <h1>Welcome to Career Connect...</h1>
      <p>Your Gateway to Professional Success!</p>
    </div>
  </header>

  <main class="container">
    <section class="vision">
      <div class="content">
        <h2>Our Vision</h2>
        <p>At Career Connect, we envision a world where every professional has access to opportunities that allow them to thrive and reach their full potential. We are committed to bridging the gap between talent and opportunity.</p>
        <p>We believe in fostering a community where skills, ambitions, and aspirations are aligned with the right career paths.</p>
      </div>
    </section>

    <section class="features">
      <div class="content">
        <h2>What Sets Us Apart?</h2>
        <ul>
          <li><strong>Comprehensive Career Support:</strong> Our team of experts offers tailored advice and resources to help you navigate your career journey.</li>
          <li><strong>Advanced Matching System:</strong> Utilizing cutting-edge technology, our platform connects job seekers with employers through precise, AI-driven matches.</li>
          <li><strong>Commitment to Excellence:</strong> We are dedicated to continuous improvement and innovation, providing the best tools and resources for our users.</li>
        </ul>
      </div>
    </section>

    <section class="team">
      <div class="content">
        <h2>Our Dedicated Team</h2>
        <p>Meet the passionate individuals behind Career Connect. Our team is composed of experienced professionals from diverse backgrounds, all working together to support your career growth and success.</p>
      </div>
    </section>

    <section class="join-us">
      <div class="content">
        <h2>Become a Part of Our Network</h2>
        <p>Ready to advance your career or find the perfect candidate? Join Career Connect today and become part of a thriving community that supports your professional journey at every step.</p>
      </div>
    </section>

    <section class="contact">
  <div class="content">
    <div class="contact-details">
      <h2>Contact Information</h2>
      <div class="detail">
        <i class="fas fa-phone-alt"></i>
        <div class="info">
          <div class="label">Phone</div>
          <div class="text">+94 704598677</div>
        </div>
      </div>
      <div class="detail">
        <i class="fas fa-envelope"></i>
        <div class="info">
          <div class="label">Email</div>
          <div class="text">careerconnect@gmail.com</div>
        </div>
      </div>
      <div class="detail">
        <i class="fas fa-clock"></i>
        <div class="info">
          <div class="label">Availability</div>
          <div class="text">24/7</div>
        </div>
      </div>
    </div>
    
    <div class="contact-form">
      <h2>Contact Us</h2>
      <form action="forum.php" method="post">
        <div class="input-group">
          <input type="text" placeholder="Your Name" id="Name" name="Name" required>
        </div>
        <div class="input-group">
          <input type="email" placeholder="Your Email" id="email" name="email" required>
        </div>
        <div class="input-group">
          <input type="tel" placeholder="Your Phone Number" id="number" name="number" required>
        </div>
        <div class="input-group">
          <textarea placeholder="Your Message" id="message" name="message" required></textarea>
        </div>
        <div class="input-group">
          <button type="submit" name="submit">Send Now</button>
        </div>
      </form>
    </div>
  </div>
</section>

  </main>

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