<?php
class GestoreApi {
    private $url = "https://restcountries.com/v3.1"; // URL base dell'API

    // Funzione per ottenere una nazione
    public function getNazione($name) {
        $url = $this->url . "/name/" . urlencode($name); // Costruisce l'URL
        return $this->estraiDati($url); // Estrae i dati
    }

    // Funzione per ottenere una nazione random
    public function ottieniNazioneRandom() {
        $allCountries = $this->getTutteLeNazioni(); // Ottiene tutte le nazioni
        if (!$allCountries) return false; // Controlla se ci sono nazioni
        
        $randomIndex = array_rand($allCountries); // Sceglie un indice random
        return $allCountries[$randomIndex]; // Restituisce la nazione
    }

    // Funzione per ottenere tutte le nazioni
    public function getTutteLeNazioni() {
        $url = $this->url . "/all"; // Costruisce l'URL
        return $this->estraiDati($url); // Estrae i dati
    }

    // Funzione privata per estrarre i dati
    private function estraiDati($url) {
        $ch = curl_init(); // Inizia una sessione cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Imposta l'URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Imposta il ritorno della risposta
        $response = curl_exec($ch); // Esegue la richiesta
        curl_close($ch); // Chiude la sessione cURL
        return json_decode($response, true); // Decodifica la risposta JSON
    }
}
?>