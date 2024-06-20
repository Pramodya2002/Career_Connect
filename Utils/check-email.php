<?php
    if(isset($_GET['email']) && isset($_GET['ajaxRequest'])){
        require_once 'db-conn.php';

        $email = $_GET['email'];
        $sql = "SELECT * FROM applicants a, employers e WHERE a.email = ? OR e.email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo "true";
        }else{
            echo "false";
        }
    }else{
        echo "Email is required";
    }
?>