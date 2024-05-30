<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change this to your MySQL username if different
$password = ""; // Change this to your MySQL password if set
$dbname = "animal_booking"; // Change this to the name of your database

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute SQL queries
function execute_query($sql)
{
    global $conn;
    $result = $conn->query($sql);
    return $result;
}

// Function to sanitize input data
function sanitize_data($data)
{
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}
?>