<?php

session_start();


function check_admin_auth() {
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); 
        exit;
    }

    
    
    include '../includes/db.php'; 

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id=$user_id AND role='admin'";
    $result = execute_query($sql);

    if ($result->num_rows != 1) {
        header("Location: login.php"); 
        exit;
    }
}
?>
