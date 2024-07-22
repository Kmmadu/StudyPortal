<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Check if the user already exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                // Registration successful, redirect to login page
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registration Successful</title>
                    <style>
                        .loader {
                            border: 16px solid #f3f3f3;
                            border-radius: 50%;
                            border-top: 16px solid #3498db;
                            width: 70px;
                            height: 70px;
                            animation: spin 2s linear infinite;
                            margin: 0 auto;
                            margin-top: 20%;
                        }

                        @keyframes spin {
                            0% { transform: rotate(0deg); }
                            100% { transform: rotate(360deg); }
                        }
                    </style>
                </head>
                <body>
                    <h2>Registration successful</h2>
                    <div class="loader"></div>
                    <p>You will be redirected to the login page in 5 seconds...</p>
                    <script>
                        setTimeout(function(){
                            window.location.href = "signin.html";
                        }, 5000);
                    </script>
                </body>
                </html>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "User already exists with this email.";
        }
    } else {
        echo "Please fill in all fields.";
    }

    $conn->close();
} else {
    echo 'Invalid request method';
}
?>
