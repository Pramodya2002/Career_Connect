<?php
if(!isset($DASHBOARD) || !$DASHBOARD == true){
	header('Location: ../dashboard.php');
}

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['user_id'])){
        header('Location: ../auth.php?error[]=You need to login first');
    }

    require_once 'utils/db-conn.php';

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];

    if($user_type != 'admin'){
        header('Location: ../index.php?error[]=You are not authorized to access this page');
    }

    $sql = "SELECT * FROM contact_us WHERE 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    echo "<div class='applicant-container'>Messages</div>";
    if($result->num_rows == 0){
        echo "<div class='applicant-container'>No Messages found</div>";
    }else{
        $messages = $result->fetch_all(MYSQLI_ASSOC);     
        foreach($messages as $message){
            echo "
                    <div class='applicant-container row-gap-10'>
                        <div class='colspan-1-3'><span class='aname'>".$message['name']."</span><span class='atype'>".$message['email']." :<span class='auname'>".$message['phone']."</span></span></div>
                        <div class='download'>
                            
                        </div>
                        <div class='desc colspan-1-3'>".$message['message']."</div>
                        <div class='approve'> 
                        </div>
                    </div>";
        }
    }
?>