<?php
session_start();
require 'database.php';

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Validate credentials
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verify password (assuming passwords are hashed)
    if (password_verify($password, $row['password'])) {
        // Login successful
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['email'] = $row['email'];
        header("Location: index.php");
        exit();
    } else {
        // Invalid password
        $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: log_in/index.php");
        exit();
    }
} else {
    // User not found
    $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
    header("Location: log_in/index.php");
    exit();
}

// Close connection
$stmt->close();
$conn->close();
?>