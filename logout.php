<?php
// Start a session
session_start();

// Destroy the session data
session_destroy();

// Redirect to the user login page
header("Location: login.php");
exit;
?>
