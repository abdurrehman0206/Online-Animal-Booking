<?php

session_start();


include 'includes/db.php';


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
  <title>Login - Online Animal Booking System</title>
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
      <h2>Welcome Back!</h2>
      <p>Please enter log in details below</p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group form-group">
		<input type="text" id="username" name="username" value="<?php echo $username; ?>" placeholder="Email" required>
        </div>
        <div class="input-group form-group">
		<input type="password" id="password" name="password" placeholder="Username" required>
          <i class="fas fa-eye"></i>
        </div>
        <a href="#" class="forgot-password">Forget password?</a>
        <button type="submit" class="sign-in-btn">Sign in</button>
		<?php if ($error != '')
				echo '<p class="error">' . $error . '</p>'; ?>
      </form >
      <p class="sign-up-text">Don't have an account? <a href="register.php">Sign Up</a></p>
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
