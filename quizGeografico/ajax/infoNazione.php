<?php
session_start();
require_once '../classi/GestoreApi.php';


// Controlla se il parametro countryName è presente nell'URL
if (isset($_GET['countryName']) && !empty(trim($_GET['countryName']))) {
    $countryName = trim($_GET['countryName']);
    $client = new GestoreApi();
    
    try {
        $countryInfo = $client->getNazione($countryName);
        
        if ($countryInfo && !isset($countryInfo['status'])) {
            // Restituisce solo il primo risultato
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
    } catch (Exception $e) {
        $ret = [
            "status" => "ERR",
            "msg"    => "Errore durante la ricerca: " . $e->getMessage()
        ];
    }
} else {
    $ret = [
        "status" => "ERR",
        "msg"    => "Devi specificare un nome di paese valido"
    ];
}

echo json_encode($ret);
exit();
?>