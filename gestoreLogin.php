<?php

session_start();
include_once "../classi/GestoreQuery.php";



// Recupera i dati GET
$username = $_GET["username"];
$password = $_GET["password"];

$passwordHash=md5($password);


// Query parametrizzata per evitare iniezioni SQL
$stmt = $conn->prepare("SELECT * FROM utenti WHERE username = ? AND password= ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $_SESSION['username'] = $username;
    $_SESSION['autenticato'] = true;
    header("Location: paginaPrincipale.php");

} else {
    echo "Utente non trovato";
}
?>