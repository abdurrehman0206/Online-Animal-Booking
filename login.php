<?php

// Start a session
// session_start();

// Check if the user is already logged in, redirect to dashboard if logged in
if (isset($_SESSION['user_id'])) {
	header("Location: admin/index.php");
	exit;
}

// Include the db.php file to establish a database connection
include 'includes/db.php';

// Initialize variables
$username = $password = '';
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Sanitize input data
	$username = sanitize_data($_POST['username']);
	$password = sanitize_data($_POST['password']);

	// Check if the username and password are correct
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = execute_query($sql);

	if ($result->num_rows == 1) {
		// Login successful, store user ID in session and redirect to dashboard
		$row = $result->fetch_assoc();
		$_SESSION['user_id'] = $row['id'];
		header("Location: admin/index.php");
		exit;
	} else {
		// Login failed, display error message
		$error = "Invalid username or password";
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Online Animal Booking System</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<h2>Login</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required>
			</div>
			<button type="submit">Login</button>
			<?php if ($error != '')
				echo '<p class="error">' . $error . '</p>'; ?>
		</form>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>