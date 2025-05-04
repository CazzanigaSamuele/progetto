<?php
session_start(); // Inizia la sessione
require_once '../classi/GestoreApi.php'; // Include la classe GestoreApi

$client = new GestoreApi(); // Crea un'istanza di GestoreApi
$countries = $client->getTutteLeNazioni(); // Ottiene tutte le nazioni

// Controlla se ci sono nazioni
if ($countries) {
    $randomIndex = array_rand($countries); // Sceglie un indice random
    $randomCountry = $countries[$randomIndex]; // Ottiene la nazione
    
    // Salva il nome del paese corretto per il quiz
    $_SESSION['currentCountry'] = $randomCountry['name']['common'];
    
    // Restituisce i dati in formato JSON
    $ret = [
        "status"      => "OK",
        "flagUrl"     => $randomCountry['flags']['png'],
        "countryName" => $randomCountry['name']['common']
    ];
} else {
    // Restituisce un errore in formato JSON
    $ret = [
        "status" => "ERR",
        "msg"    => "Impossibile caricare la bandiera"
    ];
}

echo json_encode($ret); // Restituisce il risultato
die();
?>