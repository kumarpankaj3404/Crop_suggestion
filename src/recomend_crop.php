<?php
// Database credentials from InfinityFree
$servername = "sql107.infinityfree.com";
$username = "if0_38716230";
$password = "Kn4rgF3rqH0Pi5D"; // 🔒 Replace with your actual InfinityFree DB password
$dbname = "if0_38716230_crop_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form input
$nitrogen = $_POST['nitrogen'] ?? '';
$phosphorous = $_POST['phosphorous'] ?? '';
$potassium = $_POST['potassium'] ?? '';
$temperature = $_POST['temperature'] ?? '';
$humidity = $_POST['humidity'] ?? '';
$ph = $_POST['ph'] ?? '';
$rainfall = $_POST['rainfall'] ?? '';

// Prepare SQL insert
$sql = "INSERT INTO crop_data (nitrogen, phosphorous, potassium, temperature, humidity, ph, rainfall)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiddd", $nitrogen, $phosphorous, $potassium, $temperature, $humidity, $ph, $rainfall);

if ($stmt->execute()) {
    echo "Crop data inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
