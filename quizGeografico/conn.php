<?php
    // Connessione al database
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'quiz_geografici';
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }
?>