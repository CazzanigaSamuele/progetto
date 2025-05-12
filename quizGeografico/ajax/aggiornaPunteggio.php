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

if (isset($_GET['corretto'])) {
    if ($_GET['corretto'] == 'true') {
        $_SESSION['punteggio']++;
        $ret = [
            'status' => 'OK',
            'punteggio' => $_SESSION['punteggio']
        ];
    } elseif ($_GET['corretto'] == 'false') {
        // ⚠️ Prima di azzerare, salviamo il punteggio precedente
        $ultimoPunteggio = $_SESSION['punteggio'];

        // Reindirizzeremo da JS a salvaPunteggio.php con questo valore
        $_SESSION['punteggio'] = 0; // Reset per prossima partita

        $ret = [
            'status' => 'OK',
            'punteggio' => 0, // Punteggio attuale è 0
            'ultimoPunteggio' => $ultimoPunteggio // 👈 lo includiamo per JS
        ];
    }
}

echo json_encode($ret);
die();
?>