<?php
$servername = "localhost";
$username = "codeak";
$password = "5334";
$dbname = "studenthub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
