<?php
class GestoreApi {
    private $url = "https://restcountries.com/v3.1";

    public function getNazione($name) {
        $url = $this->url . "/name/" . urlencode($name);
        return $this->estraiDati($url);
    }

    public function getRandomCountry() {
        $allCountries = $this->getTutteLeNazioni();
        if (!$allCountries) return false;
        
        $randomIndex = array_rand($allCountries);
        return $allCountries[$randomIndex];
    }

    public function getTutteLeNazioni() {
        $url = $this->url . "/all";
        return $this->estraiDati($url);
    }

    private function estraiDati($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
?>