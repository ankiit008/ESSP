<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$db_username = "root"; // replace with your database username
$db_password = ""; // replace with your database password
$dbname = "essp"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define test user data
$email = 'test@example.com';
$password = 'your_password';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
if ($stmt) {
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $stmt->close();
    echo "Test user inserted successfully!";
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close connection
$conn->close();
?>
