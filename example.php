<?php

require_once __DIR__ . '/vendor/autoload.php';

use JobBrander\Moonclerk\Client as MoonclerkClient;

include_once('config.php');

$client = new MoonclerkClient($api_key);
$filters = [
    'count' => '20',
    'offset' => '0'
];

$forms = $client->getForms();
echo "<pre>"; print_r($forms); echo "</pre>";

$payments = $client->getPayments($filters);
echo "<pre>"; print_r($payments); echo "</pre>";

$customers = $client->getCustomers($filters);
echo "<pre>"; print_r($customers); echo "</pre>";

/* Optional Filters Example:
 *  $filters = [
 *      'form_id' => 'XXXXX',
 *      'customer_id' => 'XXXXX',
 *      'date_from' => '2014-10-31',
 *      'date_to' => '2015-12-31',
 *      'status' => 'refunded'
 *  ];
 *
 *  Filters for Payments: https://github.com/moonclerk/developer/blob/master/api/v1/payments.md#filters
 *  Filters for Customers: https://github.com/moonclerk/developer/blob/master/api/v1/customers.md#filters
 *  Add Paging as a filter: https://github.com/moonclerk/developer/tree/master/api#paging
 */
