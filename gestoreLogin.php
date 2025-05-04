<?php
    session_start(); // Inizia la sessione
    include "conn.php"; // Include il file di connessione al database

    // Recupera i dati GET (username e password)
    $username = $_GET["username"];
    $password = $_GET["password"];

    // Hash della password
    $passwordHash=md5($password);

    // Query per selezionare l'utente dal database
    $query="SELECT * FROM `utenti` WHERE username='$username' && password='$passwordHash';";
    $risultato=$conn->query($query);

    // Controlla se l'utente esiste
    if($risultato->num_rows>0){
        // Imposta le variabili di sessione
        $_SESSION["autenticato"]=true;
        $_SESSION["username"]=$username;
        // Reindirizza all'pagina principale
        header("Location: paginaPrincipale.php"); 
        exit;
    }else{
        // Reindirizza alla pagina di login con un messaggio di errore
        header("Location:login.php?messaggio=credenziali errate!");
        exit;
    }
?>