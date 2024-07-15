<?php
require 'db_connect.php';
require 'vendor/autoload.php';

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
    $sql = "SELECT * FROM users WHERE email='" . $userProfile->email . "' AND auth_provider_id='" . $userProfile->identifier . "'";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception('Error querying users: ' . $conn->error);
    }

    if ($result->num_rows == 0) {
        // Register the user
        $sql = "INSERT INTO users (username, email, auth_provider, auth_provider_id) VALUES ('" . $userProfile->displayName . "', '" . $userProfile->email . "', $provider_id, '" . $userProfile->identifier . "')";
        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully with Google";
        } else {
            throw new Exception('Error inserting user: ' . $conn->error);
        }
    } else {
        echo "User logged in successfully with Google";
    }

    $adapter->disconnect();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
} finally {
    $conn->close();
}
?>
