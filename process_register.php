<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require 'db_connect.php';
require 'vendor/autoload.php';
session_start();

try {
    $config = require 'hybridauth_config.php';
    $hybridauth = new Hybridauth\Hybridauth($config);
    
    $adapter = $hybridauth->authenticate('Google');
    $userProfile = $adapter->getUserProfile();

    // Check if the auth provider exists
    $sql = "SELECT * FROM auth_providers WHERE provider_name='Google'";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception('Error querying auth providers: ' . $conn->error);
    }

    if ($result->num_rows == 0) {
        $conn->query("INSERT INTO auth_providers (provider_name) VALUES ('Google')");
        $provider_id = $conn->insert_id;
    } else {
        $provider = $result->fetch_assoc();
        $provider_id = $provider['id'];
    }

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email='" . $conn->real_escape_string($userProfile->email) . "' AND auth_provider_id='" . $conn->real_escape_string($userProfile->identifier) . "'";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception('Error querying users: ' . $conn->error);
    }

    if ($result->num_rows == 0) {
        // Register the user
        $sql = "INSERT INTO users (username, email, auth_provider_id, auth_provider) VALUES ('" . $conn->real_escape_string($userProfile->displayName) . "', '" . $conn->real_escape_string($userProfile->email) . "', $provider_id, '" . $conn->real_escape_string($userProfile->identifier) . "')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $userProfile->displayName;
            echo "User registered successfully with Google";
            header("Location: index.html");
            exit(); // Ensure no further code is executed
        } else {
            throw new Exception('Error inserting user: ' . $conn->error);
        }
    } else {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "User logged in successfully with Google";
        header("Location: index.html");
        exit(); // Ensure no further code is executed
    }

    $adapter->disconnect();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} finally {
    $conn->close();
}
?>
