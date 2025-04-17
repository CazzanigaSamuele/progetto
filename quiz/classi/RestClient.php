<?php
class RestClient {
    private $baseUrl = "https://restcountries.com/v3.1";

    public function getCountryByName($name) {
        $url = $this->baseUrl . "/name/" . urlencode($name);
        return $this->fetchData($url);
    }

    public function getAllCountries() {
        $url = $this->baseUrl . "/all";
        return $this->fetchData($url);
    }

    private function fetchData($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
?>