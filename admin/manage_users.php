<?php
// Start a session
session_start();
include '../includes/db.php';
include 'auth_admin.php'; 
check_admin_auth();

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = execute_query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manage Users - Admin - Online Animal Booking System</title>
	<link rel="stylesheet" href="../css/styles.css">
</head>

<body>
<?php include '../includes/admin_header.php'; ?>

	<main>
		<table>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Role</th>
				<th>Action</th>
			</tr>
			<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['role']; ?></td>
					<td>
						<form method="post" action="update_role.php">
							<input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
							<select name="role">
								<option value="admin" <?php echo $row['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
								<option value="user" <?php echo $row['role'] === 'user' ? 'selected' : ''; ?>>User</option>
							</select>
							<button type="submit">Update Role</button>
						</form>
					</td>
				</tr>
			<?php endwhile; ?>
		</table>
	</main>

	<?php include '../includes/footer.php'; ?>
</body>

</html>