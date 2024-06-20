<?php
require 'utils/db-conn.php';
if (isset($_POST['submit'])) {

    $Name = $_POST['Name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    $sql = "insert into contact_us(Name,email,phone,message) values(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $Name, $email, $number, $message);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: aboutus.php?message=Message sent successfully");
        exit();
    } else {
        header("Location: aboutus.php?error=Message not sent");
        exit();
    }
}
?>
