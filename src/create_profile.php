<!-- CREATE TABLE farmer_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    farm_name VARCHAR(100) NOT NULL,
    farm_size DECIMAL(10,2) NOT NULL,
    location VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "crop");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $farm_name = mysqli_real_escape_string($conn, $_POST['farm_name']);
    $farm_size = mysqli_real_escape_string($conn, $_POST['farm_size']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $sql = "INSERT INTO farmer_profiles (name, email, farm_name, farm_size, location)
            VALUES ('$name', '$email', '$farm_name', '$farm_size', '$location')";

    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color: green;'>Profile created successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

mysqli_close($conn);

// Include the form page and use $message there
include 'profile.php';
?>