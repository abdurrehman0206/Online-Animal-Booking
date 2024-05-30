<?php

include '../includes/db.php';
include 'auth_admin.php'; 
check_admin_auth();

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
<?php include '../includes/admin_header.php'; ?>
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