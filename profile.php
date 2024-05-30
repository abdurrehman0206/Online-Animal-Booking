<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];


$sql_user = "SELECT * FROM users WHERE id=$user_id";
$result_user = execute_query($sql_user);

if ($result_user->num_rows == 1) {
	$user = $result_user->fetch_assoc();
} else {
	echo "User not found";
	exit;
}

$sql_booking = "SELECT b.*, a.name AS animal_name 
                FROM bookings b 
                INNER JOIN animals a ON b.animal_id = a.id 
                WHERE b.user_id=$user_id";
$result_booking = execute_query($sql_booking);

$bookings = array();
if ($result_booking->num_rows > 0) {
    while ($row = $result_booking->fetch_assoc()) {
        $bookings[] = $row;
    }
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
		</ul>

		<?php if (!empty($bookings)) : ?>
			<h3>Booking Details:</h3>
			<ul>
				<?php foreach ($bookings as $booking) : ?>
					<li>
						Booking ID: <?php echo $booking['id']; ?><br>
						Animal Name: <?php echo $booking['animal_name']; ?><br>
						Booking Date: <?php echo $booking['booking_date']; ?><br>
						Status: <?php echo $booking['status']; ?><br> 
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p>No bookings found.</p>
		<?php endif; ?>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>
