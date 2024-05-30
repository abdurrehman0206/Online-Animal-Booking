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
  <link rel="stylesheet" href="./scss/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/fecfb62fb3.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="left-section">
      <div class="logo">
        <img src="logo.png" alt="Logo">
        <h1>.PetStay</h1>
      </div>
      <h2>Create an Account</h2>
      <p>Please enter your information below to create an account</p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group form-group">
		<input type="text" id="username" name="username" value="<?php echo $username; ?>" placeholder="Username" required>
        </div>
        <div class="input-group form-group">
		<input type="password" id="password" name="password" placeholder="Password" required>
          <i class="fas fa-eye"></i>
        </div>
		<div class="input-group form-group">
		<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
          <i class="fas fa-eye"></i>
        </div>
        <button type="submit" class="sign-in-btn">Sign Up</button>
		<?php if ($error != '')
				echo '<p class="error">' . $error . '</p>'; ?>
      </form >
      <p class="sign-up-text">Already have an account? <a href="login.php">Sign In</a></p>
    </div>
    <div class="right-section">
      <div class="img_login">
        <img src="./Assests/img_login.jpg" alt="loginpageImage">
      </div>
	  <h3>Book Your Animal Anywhere</h3>
<p>Now you can reserve your favorite animals from anywhere with our convenient online booking system.</p>
    </div>
  </div>
  <?php include 'includes/footer.php'; ?>
</body>
</html>