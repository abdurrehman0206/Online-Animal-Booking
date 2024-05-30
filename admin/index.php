<?php
// Include the db.php file to establish a database connection
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="../css/styles.css">
</head>

<body>
	<header>
		<h1>Admin Dashboard</h1>
		<nav>
			<a href="index.php">Dashboard</a>
			<a href="manage_animals.php">Manage Animals</a>
			<a href="manage_bookings.php">Manage Bookings</a>
		</nav>
	</header>
	<main>
		<h2>Welcome, Admin!</h2>
		<p>What would you like to do today?</p>
		<ul>
			<li><a href="manage_animals.php">Manage Animals</a></li>
			<li><a href="manage_bookings.php">Manage Bookings</a></li>
		</ul>
	</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> Online Animal Booking System</p>
	</footer>
</body>

</html>