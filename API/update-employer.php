<?php
function updateEmployer($conn, $user_id){
    if (isset($_POST['company_name'])) {
        $sql = "UPDATE employers SET company_name = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_POST['company_name'], $user_id);
    }

    if (isset($_POST['address'])) {
        $sql = "UPDATE employers SET address = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_POST['address'], $user_id);
    }

    if (isset($_POST['phone'])) {
        $sql = "UPDATE employers SET phone = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_POST['phone'], $user_id);
    }

        

    $stmt->execute();
}
?>