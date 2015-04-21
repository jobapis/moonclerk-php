<?php

require_once __DIR__ . '/vendor/autoload.php';

use JobBrander\Moonclerk\Client as MoonclerkClient;

include_once('config.php');

$client = new MoonclerkClient($api_key);

$forms = $client->getForms();

echo "<pre>"; print_r($forms); echo "</pre>";
