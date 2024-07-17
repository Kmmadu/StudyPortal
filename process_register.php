<?php
require 'db_connect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");


$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    // Display success message and redirect using JavaScript
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

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
