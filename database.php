<?php
// Database connection details
$servername = "localhost"; // Server name (default for XAMPP)
$username = "root";        // Default username for XAMPP
$password = "";            // Default password is empty for XAMPP
$dbname = "login_system"; // Replace with your database name

// Create connection
$conn = new mysqli($serv
ername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

wamp