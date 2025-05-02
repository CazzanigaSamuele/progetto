<?php
session_start();

// Inizializza il punteggio se non esiste
if (!isset($_SESSION['punteggio'])) {
    $_SESSION['punteggio'] = 0;
}

// Valore di default
$ret = [
    'status' => 'ERR',
    'punteggio' => $_SESSION['punteggio']
];

// Gestione logica del punteggio
if (isset($_GET['corretto'])) {
    if ($_GET['corretto'] === 'true') {
        $_SESSION['punteggio']++;
        $ret = [
            'status' => 'OK',
            'punteggio' => $_SESSION['punteggio']
        ];
    } elseif ($_GET['corretto'] === 'false') {
        $_SESSION['punteggio'] = 0; // Azzeramento punteggio
        $ret = [
            'status' => 'OK',
            'punteggio' => $_SESSION['punteggio']
        ];
    }
}

echo json_encode($ret);
die();
?>