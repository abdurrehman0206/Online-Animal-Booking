<?php

session_start();


include '../includes/db.php';


$username = $password = '';
$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = sanitize_data($_POST['username']);
	$password = sanitize_data($_POST['password']);

	
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='user'";
	$result = execute_query($sql);

	if ($result->num_rows == 1) {
		
		$row = $result->fetch_assoc();
		$_SESSION['user_id'] = $row['id'];
		header("Location: index.php");
		exit;
	} else {
		
		$error = "Invalid username or password";
	}
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - User - Online Animal Booking System</title>
	<link rel="stylesheet" href="../css/styles.css">
</head>

<body>
	<header>
		<h1>User Login</h1>
	</header>

	<main>
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

	<?php include '../includes/footer.php'; ?>
</body>

</html>