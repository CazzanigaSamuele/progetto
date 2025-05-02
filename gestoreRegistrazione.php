<?php
include "conn.php";

// Recupera i dati GET
$username = $_GET["username"] ?? '';
$password = $_GET["password"] ?? '';

if (empty($username) || empty($password)) {
    echo "Username e password sono obbligatori";
    exit();
}

// Hash della password con password_hash()
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query parametrizzata per evitare iniezioni SQL
$stmt = $conn->prepare("INSERT INTO utenti (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $passwordHash);

if ($stmt->execute()) {
    header("Location: login.php");
} else {
    echo "Errore durante la registrazione";
}
?>