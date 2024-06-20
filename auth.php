<?php
session_start();

require_once 'utils/db-conn.php';
require_once 'utils/gen-id.php';

// Function to check if the user is already logged in
function checkLoggedIn() {
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        header("Location: ./index.php"); // Redirect to index page if logged in
        exit;
    }
}

// Check if user is already logged in
checkLoggedIn();

if (isset($_POST['l_submit'])) {
    $email = $_POST['l_email'];
    $passwd = $_POST['l_passwd'];

    $sql = "(SELECT user_id FROM applicants WHERE email = ? AND password = ?)
    UNION
    (SELECT user_id FROM employers WHERE email = ? AND password = ?);
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $passwd, $email, $passwd);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['login'] = true;

        if ($_SESSION['user_id'][0] == 'u') {
            $_SESSION['type'] = 'applicant';
        } else if ($_SESSION['user_id'][0] == 'e'){
            $_SESSION['type'] = 'employer';
        } else if ($_SESSION['user_id'][0] == 'a'){
            $_SESSION['type'] = 'admin';
        } else {
            header('Location: ./auth.php?error[]=Invalid user type');
            exit;
        }

        header("Location: ./index.php?success[]=Logged in successfully");
        exit;
    } else {
        header('Location: ./auth.php?error[]=Invalid email or password');
        exit;
    }
}

if (isset($_POST['r_submit'])) {
    $email = $_POST['r_email'];
    $passwd = $_POST['r_passwd'];

    if (isset($_POST['uType'])) {
        $type = 'employer';
        $user_id = generateID('e');
        $sql = "INSERT INTO employers (user_id, email, password) VALUES (?, ?, ?)";
    } else {
        $type = 'applicant';
        $user_id = generateID('u');
        $sql = "INSERT INTO applicants (user_id, email, password) VALUES (?, ?, ?)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $user_id, $email, $passwd);
    $stmt->execute();

    $profile_dir = "profiles/$type/$user_id/";
    require_once 'utils/create-profile.php';

    createProfile($profile_dir);

    header("Location: ./auth.php?success[]=Account created successfully");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>Insert title here</title>

    <link rel="shortcut icon" type="image/png" href="src/img/icon.png">
    <link type="text/css" rel="stylesheet" href="src/css/theme.css">
    <link type="text/css" rel="stylesheet" href="src/css/main.css">
    <link type="text/css" rel="stylesheet" href="src/css/auth.css">

    <script src="src/js/jquery-3.7.1.min.js"></script>
    <script src="src/js/error.js"></script>
    <script src="src/js/auth.js"></script>

    <script>
        // Function to toggle between login and registration forms
        function toggleMode() {
            var logForm = document.getElementById('log');
            var regForm = document.getElementById('reg');
            var toggleButton = document.getElementById('tog');

            if (logForm.style.display === 'none') {
                logForm.style.display = 'block';
                regForm.style.display = 'none';
                toggleButton.textContent = 'CREATE ACCOUNT';
            } else {
                logForm.style.display = 'none';
                regForm.style.display = 'block';
                toggleButton.textContent = 'LOGIN';
            }
        }
    </script>
</head>

<body>
    <div class="main-container">
        <div class="left-container"></div>
        <div class="right-container">
            <div class="tr-link">
                <button onclick="toggleMode()" id="tog">CREATE ACCOUNT</button>
            </div>
            <div class="login-container" id="log">
                <form action="" method="POST" onSubmit="return validateLogin()">
                    <div id="l-email-icon" class="input-icon email">
                        <input onInput="checkEmail()" class="in-t1" type="text" id="l-email" name="l_email" placeholder="Email" />
                    </div>
                    <div id="l-passwd-icon" class="input-icon pass">
                        <input onInput="checkPasswd()" class="in-t1" type="password" id="l-passwd" name="l_passwd" placeholder="Password" />
                    </div>
                    <input class="bt-t1" type="submit" name="l_submit" value="Login">
                    <div class="login-extra">
                        <hr>
                        <a class="login-link" href="#">Forgot password?</a>
                    </div>
                </form>
            </div>
            <div class="login-container" id="reg" style="display: none;">
                <form action="" method="POST" onSubmit="return validateReg()">
                    <label id="r-toggle-switch" class="toggle-switch-container">
                    <input type="checkbox" class="toggle-switch" id="toggle-type" name="uType">
                    <div class="toggle-slider"></div>

                    </label>
                    <div id="r-email-icon" class="input-icon email">
                        <input class="in-t1" onInput="checkREmail()" type="text" id="r-email" name="r_email" placeholder="Enter Your Email" />
                    </div>
                    <div id="brief-profile">
                        <div class="circle material-icons">person</div>
                        <div class="bp-detail-container">
                            <div class="bp-email" id="r_bp_email">example@ei.com</div>
                            <div class="bp-type" id="r_bp_type"></div>
                        </div>
                    </div>
                    <div id="r-passwd-icon" style="display: none;" class="input-icon pass">
                        <input class="in-t1" onInput="checkRPasswd()" type="password" id="r-passwd" name="r_passwd" placeholder="Enter a Password" />
                        <div>
                            <ul style="display:none" id="reg-pass-error"></ul>
                        </div>
                    </div>
                    <div id="r-rpasswd-icon" style="display: none;" class="input-icon r-pass">
                        <input class="in-t1" onInput="checkRRPasswd()" type="password" id="r-rpasswd" name="r_rpasswd" placeholder="Confirm Your Password" autocomplete="off" />
                    </div>
                    <input class="bt-t1" id="r-btn" onClick="toggleNext()" type="submit" name="r_submit" value="Next >">
                    <div class="login-extra"></div>
                </form>
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
    </div>
</body>

</html>
