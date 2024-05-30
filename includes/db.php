<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "animal_booking"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!function_exists('execute_query')) {
    
    function execute_query($sql)
    {
        global $conn;
        return $conn->query($sql);
    }
}




if (!function_exists('sanitize_data')) {
    function sanitize_data($data)
    {
        global $conn;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $conn->real_escape_string($data);
    }
}

?>