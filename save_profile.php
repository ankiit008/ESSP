<?php
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

// Get form data with validation
$father_name = isset($_POST['father_name']) ? $_POST['father_name'] : null;
$mother_name = isset($_POST['mother_name']) ? $_POST['mother_name'] : null;
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : null;
$permanent_address = isset($_POST['permanent_address']) ? $_POST['permanent_address'] : null;
$current_address = isset($_POST['current_address']) ? $_POST['current_address'] : null;
$postcode = isset($_POST['postcode']) ? $_POST['postcode'] : null;
$state = isset($_POST['state']) ? $_POST['state'] : null;
$area = isset($_POST['area']) ? $_POST['area'] : null;
$nationality = isset($_POST['nationality']) ? $_POST['nationality'] : null;
$qualification = isset($_POST['qualification']) ? $_POST['qualification'] : null;
$designation = isset($_POST['designation']) ? $_POST['designation'] : null;
$marital_status = isset($_POST['marital_status']) ? $_POST['marital_status'] : null;
$spouse_name = isset($_POST['spouse_name']) ? $_POST['spouse_name'] : null;
$current_designation = isset($_POST['current_designation']) ? $_POST['current_designation'] : null;
$join_position = isset($_POST['join_position']) ? $_POST['join_position'] : null;
$joining_date = isset($_POST['joining_date']) ? $_POST['joining_date'] : null;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO profiles (father_name, mother_name, blood_group, permanent_address, current_address, postcode, state, area, nationality, qualification, designation, marital_status, spouse_name, current_designation, join_position, joining_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssss", $father_name, $mother_name, $blood_group, $permanent_address, $current_address, $postcode, $state, $area, $nationality, $qualification, $designation, $marital_status, $spouse_name, $current_designation, $join_position, $joining_date);

// Execute statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
