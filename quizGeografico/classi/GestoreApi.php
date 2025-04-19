<?php
class GestoreApi {
    private $url = "https://restcountries.com/v3.1";
    
    public function getNazione($name) {
        if (empty(trim($name))) {
            throw new Exception("Il nome del paese non può essere vuoto");
        }
        $url = $this->url . "/name/" . urlencode(trim($name));
        return $this->estraiDati($url);
    }
    
    public function getTutteLeNazioni() {
        $url = $this->url . "/all";
        return $this->estraiDati($url);
    }
    
    private function estraiDati($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception("Errore CURL: " . $error);
        }
        
        curl_close($ch);
        
        $data = json_decode($response, true);
        
        if ($httpCode >= 400) {
            if ($httpCode == 404) {
                return null; // Paese non trovato
            } else {
                throw new Exception("Errore API: Codice HTTP " . $httpCode);
            }
        }
        
        return $data;
    }
}
?>