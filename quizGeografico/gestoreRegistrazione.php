<?php
include "conn.php"; // Include il file di connessione al database

// Recupera i dati GET (username e password)
$username = $_GET["username"] ?? '';
$password = $_GET["password"] ?? '';

// Controlla se username e password sono vuoti
if (empty($username) || empty($password)) {
    echo "Username e password sono obbligatori"; // Visualizza un messaggio di errore
    exit();
}

// Hash della password
$passwordHash = md5($password);

// Query parametrizzata per evitare iniezioni SQL
$stmt = $conn->prepare("INSERT INTO utenti (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $passwordHash);

// Esegue la query
if ($stmt->execute()) {
    // Reindirizza alla pagina di login
    header("Location: login.php");
} else {
    echo "Errore durante la registrazione"; // Visualizza un messaggio di errore
}
?>