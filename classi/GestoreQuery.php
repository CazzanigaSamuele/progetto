<?php
class GestoreQuery 
{
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function loginUtente($username, $password) {
        $query = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
        $risultato=$this->conn->query($query);
        return $risultato;
    }

    public function registraUtente($username, $password) {
        $query = "INSERT INTO utenti (username, password) VALUES ('$username', '$password')";
        return $this->conn->query($query);
    }
}


?>