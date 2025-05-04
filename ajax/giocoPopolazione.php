<?php
session_start(); // Inizia la sessione
require_once '../classi/GestoreApi.php'; // Include la classe GestoreApi

$cliente = new GestoreApi(); // Crea un'istanza di GestoreApi
$risposta = [
    'stato' => 'ERR',
    'messaggio' => 'Impossibile caricare i dati'
];

// Inizializza il punteggio e le nazioni se non esistono
if (!isset($_SESSION['punteggio'])) {
    $_SESSION['punteggio'] = 0;
}

if (!isset($_SESSION['paeseCorrente'])) {
    $_SESSION['paeseCorrente'] = $cliente->ottieniNazioneRandom();
}

if (!isset($_SESSION['paeseSuccessivo'])) {
    $_SESSION['paeseSuccessivo'] = $cliente->ottieniNazioneRandom();
}

// Gestisce la logica del gioco
if (isset($_GET['stima'])) { // Cambiato da $_POST a $_GET
    $popolazioneCorrente = $_SESSION['paeseCorrente']['population'];
    $popolazioneSuccessivo = $_SESSION['paeseSuccessivo']['population'];
    
    if ($_GET['stima'] === 'attuale' && $popolazioneCorrente > $popolazioneSuccessivo) {
        $_SESSION['punteggio']++;
        $risultato = '✅ Corretto! Popolazione più alta';
    } elseif ($_GET['stima'] === 'successivo' && $popolazioneSuccessivo > $popolazioneCorrente) {
        $_SESSION['punteggio']++;
        $risultato = '✅ Corretto! Popolazione più alta';
    } else {
        $risultato = '❌ Sbagliato! Era: ' . number_format($popolazioneSuccessivo);
        $_SESSION['punteggio'] = 0; // Resetta il punteggio se si sbaglia
    }
    
    // Prepara i dati per il prossimo round
    $_SESSION['paeseCorrente'] = $_SESSION['paeseSuccessivo'];
    $_SESSION['paeseSuccessivo'] = $cliente->ottieniNazioneRandom();
    
    $risposta = [
        'stato' => 'OK',
        'punteggio' => $_SESSION['punteggio'],
        'risultato' => $risultato,
        'paeseAttuale' => [
            'nome' => $_SESSION['paeseCorrente']['name']['common'],
            'popolazione' => number_format($_SESSION['paeseCorrente']['population']),
            'bandiera' => $_SESSION['paeseCorrente']['flags']['png']
        ],
        'paeseSuccessivo' => [
            'nome' => $_SESSION['paeseSuccessivo']['name']['common'],
            'bandiera' => $_SESSION['paeseSuccessivo']['flags']['png']
        ],
        'popolazioneRivelata' => number_format($popolazioneSuccessivo)
    ];
} else {
    $risposta = [
        'stato' => 'OK',
        'punteggio' => $_SESSION['punteggio'],
        'paeseAttuale' => [
            'nome' => $_SESSION['paeseCorrente']['name']['common'],
            'popolazione' => number_format($_SESSION['paeseCorrente']['population']),
            'bandiera' => $_SESSION['paeseCorrente']['flags']['png']
        ],
        'paeseSuccessivo' => [
            'nome' => $_SESSION['paeseSuccessivo']['name']['common'],
            'bandiera' => $_SESSION['paeseSuccessivo']['flags']['png']
        ]
    ];
}

echo json_encode($risposta);
die();