<?php namespace JobBrander\Moonclerk;

use GuzzleHttp\Client as GuzzleClient;

/**
* Class for communicating with the Moonclerk API
*/
class Client
{
    protected $client, $baseUrl, $apiKey;

    public function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = 'https://api.moonclerk.com/';
        $this->client = new GuzzleClient();
    }

    public function getForms()
    {
        return $this->get('forms');
    }

    public function getForm($id = null)
    {
        return $this->get('forms/'.$id);
    }

    public function getPayments($filters = [])
    {
        return $this->get('payments', $filters);
    }

    public function getPayment($id = null)
    {
        return $this->get('payments/'.$id);
    }

    public function getCustomers($filters = [])
    {
        return $this->get('customers', $filters);
    }

    public function getCustomer($id = null)
    {
        return $this->get('customers/'.$id);
    }

    private function get($path = '', $filters = [])
    {
        try {
            $path = $path.$this->addFilters($filters);
            $response = $this->getResponse($path);
            if ($response->getStatusCode() == '200') {
                return json_decode($response->getBody(true));
            }
        } catch ( \Exception $e) {
            // Handle errors
            print_r($e); exit;
            echo $e->getMessage();
        }
        return null;
    }

    private function addFilters($filters = [])
    {
        return '';
    }

    private function getResponse($path = '')
    {
        return $this->client->get($this->baseUrl.$path, [
            'headers' => [
                'authorization' => 'Token token='.$this->apiKey,
                'accept' => 'application/vnd.moonclerk+json;version=1',
            ]
        ]);
    }

}
