 
<?php
include '../includes/db.php';
include 'auth_admin.php'; 
check_admin_auth();
// Initialize variables
$message = '';


// Check if the form is submitted to add a new animal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_animal'])) {
    // Sanitize and validate input data
    $name = sanitize_data($_POST['name']);
    $species = sanitize_data($_POST['species']);
    $age = intval($_POST['age']);
    $description = sanitize_data($_POST['description']);

    // Upload image file
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $newFileName = uniqid() . '.' . $imageFileType;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newFileName)) {
        // Insert animal record into the database
        $sql = "INSERT INTO animals (name, species, age, description, image) VALUES ('$name', '$species', $age, '$description', '$newFileName')";
        if ($conn->query($sql) === TRUE) {
            $message = "New animal added successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Sorry, there was an error uploading your file.";
    }
}

// Query to fetch all animals from the database
$sql = "SELECT * FROM animals";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Animals</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php include '../includes/admin_header.php'; ?>
    <main>
        <h2>Add New Animal</h2>
        <?php if ($message != '') echo '<p class="message">' . $message . '</p>'; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="species">Species:</label>
            <input type="text" id="species" name="species" required><br>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea><br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br>
            <button type="submit" name="add_animal">Add Animal</button>
        </form>

        <h2>Animal Records</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Species</th>
                <th>Age</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["species"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td><img src='../images/" . $row["image"] . "' alt='" . $row["name"] . "'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No animals found</td></tr>";
            }
            ?>
        </table>
    </main>
	<?php include '../includes/footer.php'; ?>

</body>
</html>
