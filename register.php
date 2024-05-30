<?php

include 'includes/db.php';


$username = $password = $confirm_password = '';
$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = sanitize_data($_POST['username']);
	$password = sanitize_data($_POST['password']);
	$confirm_password = sanitize_data($_POST['confirm_password']);

	
	if ($password != $confirm_password) {
		$error = "Passwords do not match";
	} else {
		
		$sql = "SELECT id FROM users WHERE username='$username'";
		$result = execute_query($sql);

		if ($result->num_rows > 0) {
			$error = "Username already exists";
		} else {
	
			$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
			if (execute_query($sql)) {
	
				header("Location: login.php");
				exit;
			} else {
				$error = "Registration failed";
			}
		}
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register - Online Animal Booking System</title>
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<h2>Register</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm Password:</label>
				<input type="password" id="confirm_password" name="confirm_password" required>
			</div>
			<button type="submit">Register</button>
			<?php if ($error != '')
				echo '<p class="error">' . $error . '</p>'; ?>
		</form>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>

</html>