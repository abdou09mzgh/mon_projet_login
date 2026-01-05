<?php
session_start();
require 'database.php';

// Get form data
$username = $_POST['username'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if username or email already exists
$sql = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "Nom d'utilisateur ou email déjà utilisé.";
    header("Location: log_in/index.php");
    exit();
}

$sql = "INSERT INTO users (username, nom, prenom, email, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));
$stmt->execute();

$_SESSION['user_id'] = $stmt->insert_id;
$_SESSION['username'] = $username;
$_SESSION['nom'] = $nom;
$_SESSION['prenom'] = $prenom;
$_SESSION['email'] = $email;
header("Location: index.php");
exit();
?>