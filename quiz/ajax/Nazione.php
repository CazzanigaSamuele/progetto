<?php
session_start();
include "classi/RestClient.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['countryName'])) {
    $countryName = $_POST['countryName'];
    $client = new RestClient();
    $countryInfo = $client->getCountryByName($countryName);
    
    if ($countryInfo) {
        $_SESSION['countryInfo'] = $countryInfo;
    } else {
        $_SESSION['errorMessage'] = "Paese non trovato";
    }
} else {
    $_SESSION['errorMessage'] = "Devi specificare un nome di paese";
}

header("Location: InfoNazione.php");
exit();
?>
