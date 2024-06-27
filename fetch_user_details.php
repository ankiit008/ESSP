<?php
// fetch_user_details.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "essp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM register";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p>User ID: " . $row["id"]. " - Name: " . $row["first_name"]. " - Email: " . $row["email"]. "</p>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
