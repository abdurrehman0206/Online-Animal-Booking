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

// Initialize variables
$animal_id = '';
$message = '';

// Check if the animal ID is provided in the URL
if (isset($_GET['animal_id'])) {
	$animal_id = intval($_GET['animal_id']);

	// Check if the animal exists in the database
	$sql = "SELECT * FROM animals WHERE id=$animal_id";
	$result = execute_query($sql);

	if ($result->num_rows == 0) {
		$message = "Animal not found";
	}
} else {
	$message = "Animal ID not provided";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
	// Sanitize input data
	$user_id = $_SESSION['user_id'];

	// Insert booking record into the database
	$sql = "INSERT INTO bookings (user_id, animal_id, booking_date, status) VALUES ($user_id, $animal_id, NOW(), 'Pending')";
	if (execute_query($sql)) {
		$message = "Booking successful";
	} else {
		$message = "Booking failed";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Book Animal - Online Animal Booking System</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<?php if ($message != '')
			echo '<p class="message">' . $message . '</p>'; ?>
		<?php if ($animal_id != '' && $message == ''): ?>
			<h2>Book Animal</h2>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?animal_id=' . $animal_id; ?>">
				<p>Are you sure you want to book this animal?</p>
				<button type="submit" name="book">Book</button>
			</form>
		<?php endif; ?>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>