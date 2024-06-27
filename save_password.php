<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "essp"; // Make sure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate passwords
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long!";
        exit;
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO password (password) VALUES (?)");
    $stmt->bind_param("s", $hashedPassword);

    // Execute statement
    if ($stmt->execute()) {
        echo "Password saved successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
