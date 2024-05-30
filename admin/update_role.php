<?php

session_start();

include '../includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$user_id = intval($_POST['user_id']);
	$role = sanitize_data($_POST['role']);

	
	$sql = "UPDATE users SET role='$role' WHERE id=$user_id";
	if (execute_query($sql)) {
		
		header("Location: manage_users.php");
		exit;
	} else {
		
		header("Location: manage_users.php?error=1");
		exit;
	}
} else {
	
	header("Location: manage_users.php");
	exit;
}


?>