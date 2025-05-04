<?php
session_start(); // Inizia la sessione

// Inizializza il punteggio se non esiste
if (!isset($_SESSION['punteggio'])) {
    $_SESSION['punteggio'] = 0;
}

// Valore di default
$ret = [
    'status' => 'ERR',
    'punteggio' => $_SESSION['punteggio']
];

// Gestisce la logica del punteggio
if (isset($_GET['corretto'])) {
    if ($_GET['corretto'] == 'true') {
        $_SESSION['punteggio']++;
        $ret = [
            'status' => 'OK',
            'punteggio' => $_SESSION['punteggio']
        ];
    } elseif ($_GET['corretto'] == 'false') {
        $_SESSION['punteggio'] = 0; // Azzera il punteggio
        $ret = [
            'status' => 'OK',
            'punteggio' => $_SESSION['punteggio']
        ];
    }
}

echo json_encode($ret); // Restituisce il risultato in formato JSON
die();
?>