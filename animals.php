<?php
// Include the db.php file to establish a database connection
include 'includes/db.php';

// Fetch all animals from the database
$sql = "SELECT * FROM animals";
$result = execute_query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Animals - Online Animal Booking System</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<h2>Animals</h2>
		<div class="animal-list">
			<?php if ($result->num_rows > 0): ?>
				<?php while ($row = $result->fetch_assoc()): ?>
					<div class="animal-item">
						<img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
						<h3><?php echo $row['name']; ?></h3>
						<p><?php echo $row['description']; ?></p>
						<p>Price: <?php echo $row['price']; ?> PKR</p>
						<a href="book.php?animal_id=<?php echo $row['id']; ?>">Book Now</a>
					</div>
				<?php endwhile; ?>
			<?php else: ?>
				<p>No animals found</p>
			<?php endif; ?>
		</div>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>