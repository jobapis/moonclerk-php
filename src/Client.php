<?php namespace JobBrander\Moonclerk;

use GuzzleHttp\Client as GuzzleClient;

/**
* Class for communicating with the Moonclerk API
*/
class Client
{
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient;
    }

}
