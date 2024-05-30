<?php
// Include the db.php file to establish a database connection
include 'includes/db.php';

// Check if the animal ID is provided in the URL
if (isset($_GET['animal_id'])) {
	$animal_id = intval($_GET['animal_id']);

	// Fetch the animal details from the database
	$sql = "SELECT * FROM animals WHERE id=$animal_id";
	$result = execute_query($sql);

	if ($result->num_rows == 1) {
		$animal = $result->fetch_assoc();
	} else {
		$message = "Animal not found";
	}
} else {
	$message = "Animal ID not provided";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Animal Details - Online Animal Booking System</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<?php if (isset($message)): ?>
			<p class="message"><?php echo $message; ?></p>
		<?php else: ?>
			<h2><?php echo $animal['name']; ?></h2>
			<img src="<?php echo $animal['image']; ?>" alt="<?php echo $animal['name']; ?>">
			<p>Description: <?php echo $animal['description']; ?></p>
			<p>Price: <?php echo $animal['price']; ?> PKR</p>
			<a href="book.php?animal_id=<?php echo $animal['id']; ?>">Book Now</a>
		<?php endif; ?>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>