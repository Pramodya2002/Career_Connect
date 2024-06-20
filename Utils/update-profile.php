<?php
// Connect to your database - example assuming mysqli
require_once 'utils/db-conn.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $nic = mysqli_real_escape_string($conn, $_POST['nic']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Update the user's information in the database
    $sql = "UPDATE users SET user_name='$username', name='$name', nic='$nic', email='$email', phone='$phone', address='$address' WHERE user_id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the profile page with success message
        header('Location: ../dashboard.php?success=Profile updated successfully');
        exit();
    } else {
        // Redirect back to the profile page with error message
        header('Location: ../dashboard.php?error=Failed to update profile');
        exit();
    }
} else {
    // If not a POST request, redirect to dashboard (or handle appropriately)
    header('Location: ../dashboard.php');
    exit();
}
