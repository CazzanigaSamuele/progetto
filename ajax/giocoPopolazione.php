<?php
session_start();
require_once '../classi/GestoreApi.php';

$client = new GestoreApi();
$ret = [
    'status' => 'ERR',
    'msg' => 'Impossibile caricare i dati'
];

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

if (!isset($_SESSION['currentCountry'])) {
    $_SESSION['currentCountry'] = $client->getRandomCountry();
}

if (!isset($_SESSION['nextCountry'])) {
    $_SESSION['nextCountry'] = $client->getRandomCountry();
}

if (isset($_POST['guess'])) {
    $currentPopulation = $_SESSION['currentCountry']['population'];
    $nextPopulation = $_SESSION['nextCountry']['population'];
    
    if ($_POST['guess'] === 'current' && $currentPopulation > $nextPopulation) {
        $_SESSION['score']++;
        $result = '✅ Corretto! Popolazione più alta';
    } elseif ($_POST['guess'] === 'next' && $nextPopulation > $currentPopulation) {
        $_SESSION['score']++;
        $result = '✅ Corretto! Popolazione più alta';
    } else {
        $result = '❌ Sbagliato! Era: ' . number_format($nextPopulation);
        $_SESSION['score'] = 0; // Resetta il punteggio se si sbaglia
    }
    
    // Prepariamo i dati per il prossimo round
    $_SESSION['currentCountry'] = $_SESSION['nextCountry'];
    $_SESSION['nextCountry'] = $client->getRandomCountry();
    
    $ret = [
        'status' => 'OK',
        'score' => $_SESSION['score'],
        'result' => $result,
        'currentCountry' => [
            'name' => $_SESSION['currentCountry']['name']['common'],
            'population' => number_format($_SESSION['currentCountry']['population']),
            'flag' => $_SESSION['currentCountry']['flags']['png']
        ],
        'nextCountry' => [
            'name' => $_SESSION['nextCountry']['name']['common'],
            'flag' => $_SESSION['nextCountry']['flags']['png']
        ],
        'revealedPopulation' => number_format($nextPopulation)
    ];
} else {
    $ret = [
        'status' => 'OK',
        'score' => $_SESSION['score'],
        'currentCountry' => [
            'name' => $_SESSION['currentCountry']['name']['common'],
            'population' => number_format($_SESSION['currentCountry']['population']),
            'flag' => $_SESSION['currentCountry']['flags']['png']
        ],
        'nextCountry' => [
            'name' => $_SESSION['nextCountry']['name']['common'],
            'flag' => $_SESSION['nextCountry']['flags']['png']
        ]
    ];
}

echo json_encode($ret);
die();