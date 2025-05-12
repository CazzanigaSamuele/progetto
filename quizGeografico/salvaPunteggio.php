<?php
session_start();
include "conn.php";

// Controlla se il punteggio e la tipologia sono stati passati
if (isset($_GET['score']) && isset($_GET['tipologia'])) {
    $punteggio = $_GET['score'];
    $tipologia = $_GET['tipologia'];
    
    // Verifica se l'utente è autenticato
    if (isset($_SESSION['autenticato']) && $_SESSION['autenticato'] == true) {
        $utenteId = $_SESSION['utente_id'];
        
        // Query per inserire il punteggio e la tipologia nel database
        $stmt = $conn->prepare("INSERT INTO punteggi (utente_id, punteggio, tipologia, data) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $utenteId, $punteggio, $tipologia);

        if ($stmt->execute()) {
            // Reindirizza alla pagina di fine gioco
            header("Location: giocoFinito.php?score=" . $punteggio . "&tipologia=" . urlencode($tipologia));
            exit;
        } else {
            echo "Errore durante il salvataggio del punteggio";
        }
    } else {
        // Utente non autenticato, reindirizza alla pagina di login
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: giocoFinito.php?score=0");
    exit;
}
?>
