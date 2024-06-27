<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Change this if you have set a password
    $dbname = "essp"; // Change this to your database name

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data and sanitize
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to retrieve hashed password for the given email
    $sql = "SELECT r.id, r.email, p.password 
            FROM register r
            JOIN password p ON r.id = p.id 
            WHERE r.email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Authentication successful
                $_SESSION['email'] = $email;
                header("Location: home.html"); // Redirect to home.html
                exit();
            } else {
                // Authentication failed
                echo "Invalid email or password";
            }
        } else {
            // Email not found
            echo "Invalid email or password";
        }
    } else {
        // Error in query execution
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
