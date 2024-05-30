<header>
    <h1>Online Animal Booking System</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="animals.php">Animals</a>
        <?php
        
        session_start();

        
        if (isset($_SESSION['user_id'])) {
            echo '<a href="profile.php">Profile</a>';
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
        }
        ?>
    </nav>
</header>
