<?php
session_start();

$ret = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['countryGuess'])) {
    $userGuess = $_POST['countryGuess'];
    $correctAnswer = $_SESSION['currentCountry'] ?? '';
    
    if (strtolower($userGuess) === strtolower($correctAnswer)) {
        $ret["status"] = "OK";
        $ret["msg"] = "Corretto! È il paese di " . $correctAnswer;
    } else {
        $ret["status"] = "OK";
        $ret["msg"] = "Sbagliato! È il paese di " . $correctAnswer;
    }
} else {
    $ret["status"] = "ERR";
    $ret["msg"] = "Devi inserire un nome di paese";
}

echo json_encode($ret);
die();
?>
