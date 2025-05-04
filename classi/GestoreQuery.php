<?php
class GestoreQuery 
{
    private $conn; // Connessione al database

    // Costruttore
    public function __construct($conn) {
        $this->conn = $conn; // Imposta la connessione
    }

    // Funzione per effettuare il login
    public function loginUtente($username, $password) {
        // Query per selezionare l'utente
        $query = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
        $risultato = $this->conn->query($query); // Esegue la query
        return $risultato; // Restituisce il risultato
    }

    // Funzione per registrare un utente
    public function registraUtente($username, $password) {
        // Query per inserire l'utente
        $query = "INSERT INTO utenti (username, password) VALUES ('$username', '$password')";
        return $this->conn->query($query); // Esegue la query
    }
}
?>