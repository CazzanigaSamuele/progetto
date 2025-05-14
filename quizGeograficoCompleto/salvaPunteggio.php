<?php
if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION['autenticato'])){
    header("index.php");
}
        

include "conn.php";

if (isset($_GET['score']) && isset($_GET['tipologia'])) {
    $punteggio = $_GET['score'];
    $tipologia = $_GET['tipologia'];
    
    if (isset($_SESSION['autenticato']) && $_SESSION['autenticato'] == true) {
        $utenteId = $_SESSION['utente_id'];
        
        $stmt = $conn->prepare("INSERT INTO punteggi (utente_id, punteggio, tipologia, data) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $utenteId, $punteggio, $tipologia);

        if ($stmt->execute()) {
            if(isset($_GET["nazioneCorretta"])){
                header("Location: giocoFinito.php?score=" . $punteggio . "&nazioneCorretta=".$_GET["nazioneCorretta"]."&tipologia=" . urlencode($tipologia));
            }else{
                header("Location: giocoFinito.php?score=" . $punteggio . "&tipologia=" . urlencode($tipologia));
            }
            
            $_SESSION["punteggio"]=0;
            exit;
        } else {
            echo "Errore durante il salvataggio del punteggio";
        }
    } else {
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: giocoFinito.php?score=0");
    exit;
}
?>