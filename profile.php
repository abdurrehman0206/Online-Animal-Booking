<?php
// Start a session
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

// Include the db.php file to establish a database connection
include 'includes/db.php';

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = execute_query($sql);

if ($result->num_rows == 1) {
	$user = $result->fetch_assoc();
} else {
	echo "User not found";
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile - Online Animal Booking System</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<h2>Profile</h2>
		<p>Welcome, <?php echo $user['username']; ?>!</p>
		<ul>
			<li>Username: <?php echo $user['username']; ?></li>
			<!-- You can display more user details here -->
		</ul>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>