<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="header-left">
            <img src="logo.png" alt="Logo">
        </div>
        <div class="header-right">
            <?php 
                // Start the session
                session_start(); 
            ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="nav-link">Profile</a>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="signup.html" class="nav-link">Sign Up</a>
                <a href="signin.html" class="nav-link">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <!-- rest of the HTML content -->
</body>
</html>
