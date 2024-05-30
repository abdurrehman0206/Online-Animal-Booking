<?php
// Start a session
session_start();

// Function to check if the user is authenticated and an admin
function check_admin_auth() {
    // Check if the user is authenticated
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirect to admin login page if not authenticated
        exit;
    }

    // Check if the user is an admin
    // You need to define how to identify an admin user, based on the role column in your database
    include '../includes/db.php'; // Include the db.php file to establish a database connection

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id=$user_id AND role='admin'";
    $result = execute_query($sql);

    if ($result->num_rows != 1) {
        header("Location: login.php"); // Redirect to admin login page if not an admin
        exit;
    }
}
?>
