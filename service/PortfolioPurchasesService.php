<?php

class PortfolioPurchasesService
{
    private $baseUrl='http://10.3.0.13:8000/api/portfoliopurchases';

    public function create($endpoint, $data)
    {
        return $this->sendRequest('POST', $endpoint, $data);
    }

    public function read($endpoint)
    {
        return $this->sendRequest('GET', $endpoint);
    }

    public function update($endpoint, $data)
    {
        return $this->sendRequest('PUT', $endpoint, $data);
    }

    public function delete($endpoint)
    {
        return $this->sendRequest('DELETE', $endpoint);
    }

    public function fillFields($endpoint)
    {
        return $this->sendRequest('PUT', $endpoint);
    }

    private function sendRequest($method, $endpoint, $data = null)
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

        $curl = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ];

        if ($method !== 'GET' && $data !== null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        if ($response === false) {
            return "Error: Request could not be made";
        }

        curl_close($curl);

        return $response;
    }
}

?>