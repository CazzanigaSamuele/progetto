<?php
session_start();
require_once 'classi/RestClient.php';

$client = new RestClient();
$countries = $client->getAllCountries();

if ($countries) {
    $randomIndex = array_rand($countries);
    $randomCountry = $countries[$randomIndex];
    
    // Salva il nome del paese corretto per il quiz
    $_SESSION['currentCountry'] = $randomCountry['name']['common'];
    
    $ret = [
        "status"      => "OK",
        "flagUrl"     => $randomCountry['flags']['png'],
        "countryName" => $randomCountry['name']['common']
    ];
} else {
    $ret = [
        "status" => "ERR",
        "msg"    => "Impossibile caricare la bandiera"
    ];
}

echo json_encode($ret);
die();
?>
