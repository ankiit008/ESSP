<?php
// Database connection settings
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

// Retrieve form data
$leave_type = isset($_POST['leave_type']) ? $_POST['leave_type'] : '';
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$station_leave_permit = isset($_POST['station_leave_permit']) ? $_POST['station_leave_permit'] : '';
$reason = isset($_POST['reason']) ? $_POST['reason'] : '';
$place_of_visit = isset($_POST['place_of_visit']) ? $_POST['place_of_visit'] : '';

// Validate form data
if (empty($leave_type) || empty($start_date) || empty($end_date) || empty($station_leave_permit) || empty($reason)) {
    die("Error: All required fields must be filled out.");
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO leave_applications (leave_type, start_date, end_date, station_leave_permit, reason, place_of_visit) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $leave_type, $start_date, $end_date, $station_leave_permit, $reason, $place_of_visit);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
