<?php
// Start a session
session_start();

include '../includes/db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Sanitize input data
	$user_id = intval($_POST['user_id']);
	$role = sanitize_data($_POST['role']);

	// Update the user role in the database
	$sql = "UPDATE users SET role='$role' WHERE id=$user_id";
	if (execute_query($sql)) {
		// Role updated successfully, redirect back to manage_users.php
		header("Location: manage_users.php");
		exit;
	} else {
		// Error occurred, redirect back to manage_users.php with error message
		header("Location: manage_users.php?error=1");
		exit;
	}
} else {
	// Redirect to manage_users.php if form is not submitted
	header("Location: manage_users.php");
	exit;
}


?>