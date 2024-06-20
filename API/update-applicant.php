<?php
function updateApplicant($conn, $user_id){
    if(isset($_POST['user_name'])){
        $sql = "UPDATE applicants SET user_name = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_POST['user_name'], $user_id);
    }

    if(isset($_POST['name'])){
        $sql = "UPDATE applicants SET name = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['name'], $user_id);
    }

    if(isset($_POST['nic'])){
        $sql = "UPDATE applicants SET nic = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['nic'], $user_id);
    }

    if(isset($_POST['address'])){
        $sql = "UPDATE applicants SET address = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['address'], $user_id);
    }

    if(isset($_POST['phone'])){
        $sql = "UPDATE applicants SET phone = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['phone'], $user_id);
    } 

    $stmt->execute();
}
?>