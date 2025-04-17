<?php
session_start();
require_once 'classi/RestClient.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['countryName'])) {
    $countryName = $_POST['countryName'];
    $client = new RestClient();
    $countryInfo = $client->getCountryByName($countryName);
    
    if ($countryInfo) {
        // Restituisco solo il primo risultato
        $ret = [
            "status" => "OK",
            "data"   => $countryInfo[0]
        ];
    } else {
        $ret = [
            "status" => "ERR",
            "msg"    => "Paese non trovato"
        ];
    }
} else {
    $ret = [
        "status" => "ERR",
        "msg"    => "Devi specificare un nome di paese"
    ];
}

echo json_encode($ret);
die();
?>
