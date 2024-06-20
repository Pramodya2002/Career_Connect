<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

$_SESSION['login'] = false;
$_SESSION['user_id'] = null;
$_SESSION['type'] = null;

// If it's desired to kill the session, also delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

header("Location: auth.php");
exit;
?>
