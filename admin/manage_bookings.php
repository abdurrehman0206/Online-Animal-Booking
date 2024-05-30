<?php
// Include the db.php file to establish a database connection
include '../includes/db.php';

// Initialize variables
$message = '';

// Check if the booking status is updated
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
	$booking_id = $_POST['booking_id'];
	$status = $_POST['status'];

	// Update the booking status in the database
	$sql = "UPDATE bookings SET status='$status' WHERE id=$booking_id";
	if ($conn->query($sql) === TRUE) {
		$message = "Booking status updated successfully";
	} else {
		$message = "Error updating booking status: " . $conn->error;
	}
}

// Query to fetch all booking records from the database
$sql = "SELECT bookings.*, users.username, animals.name AS animal_name 
        FROM bookings 
        INNER JOIN users ON bookings.user_id = users.id 
        INNER JOIN animals ON bookings.animal_id = animals.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Bookings</title>
	<link rel="stylesheet" href="../css/styles.css">
</head>

<body>
	<header>
		<h1>Manage Bookings</h1>
		<nav>
			<a href="index.php">Dashboard</a>
			<a href="manage_animals.php">Manage Animals</a>
			<a href="manage_bookings.php">Manage Bookings</a>
		</nav>
	</header>
	<main>
		<h2>Booking Records</h2>
		<?php if ($message != '')
			echo '<p class="message">' . $message . '</p>'; ?>
		<table>
			<tr>
				<th>ID</th>
				<th>User</th>
				<th>Animal</th>
				<th>Booking Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["id"] . "</td>";
					echo "<td>" . $row["username"] . "</td>";
					echo "<td>" . $row["animal_name"] . "</td>";
					echo "<td>" . $row["booking_date"] . "</td>";
					echo "<td>" . $row["status"] . "</td>";
					echo "<td>";
					echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
					echo "<input type='hidden' name='booking_id' value='" . $row["id"] . "'>";
					echo "<select name='status'>";
					echo "<option value='Pending' " . ($row["status"] == "Pending" ? "selected" : "") . ">Pending</option>";
					echo "<option value='Approved' " . ($row["status"] == "Approved" ? "selected" : "") . ">Approved</option>";
					echo "<option value='Rejected' " . ($row["status"] == "Rejected" ? "selected" : "") . ">Rejected</option>";
					echo "</select>";
					echo "<button type='submit' name='update_status'>Update</button>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='6'>No bookings found</td></tr>";
			}
			?>
		</table>
	</main>
	<?php include '../includes/footer.php'; ?>

</body>

</html>