<?php
// Database connection details
$servername = "localhost"; // Server name (default for XAMPP/WAMP)
$username = "root";        // Default username
$password = "";            // Default password
$dbname = "login_system";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
wamp