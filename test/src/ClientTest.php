<?php namespace JobBrander\Moonclerk\Test;

use JobBrander\Moonclerk\Client;
use Mockery as m;

/**
 *  Uses PHPUnit to test methods and properties set in
 *  the generic Collection class.
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $api_key = 'xxx';
        $this->baseUrl = 'https://api.moonclerk.com/';
        $this->moonclerk = new Client($api_key);
        $this->moonclerk->client =  m::mock('GuzzleHttp\Client');
        $this->headers = [
            'headers' => [
                'authorization' => 'Token token='.$api_key,
                'accept' => 'application/vnd.moonclerk+json;version=1',
            ]
        ];
    }

    public function testItGetsForms()
    {
        $response = m::mock('GuzzleHttp\Message\Response');
        $results = (object) [
            'forms' => [
                0 => (object) [
                    'id' => 'XXXX',
                    'title' => 'Job Seeker Test',
                    'access_token' => '123ckck',
                    'currency' => 'USD',
                    'payment_volume' => '0',
                    'successful_checkout_count' => '1',
                    'created_at' => '2015-04-21T00:23:15Z',
                    'updated_at' => '2015-04-21T00:58:38Z',
                ]
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'forms', $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($results));

        $forms = $this->moonclerk->getForms();
        $this->assertEquals($results, $forms);
    }

    public function testItGetsFormById()
    {
        $id = 'XXXX';
        $response = m::mock('GuzzleHttp\Message\Response');
        $result = (object) [
            'form' => (object) [
                'id' => $id,
                'title' => 'Job Seeker Test',
                'access_token' => '123ckck',
                'currency' => 'USD',
                'payment_volume' => '0',
                'successful_checkout_count' => '1',
                'created_at' => '2015-04-21T00:23:15Z',
                'updated_at' => '2015-04-21T00:58:38Z',
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'forms/'.$id, $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($result));

        $form = $this->moonclerk->getForm($id);
        $this->assertEquals($result, $form);
    }

    public function testItGetsPayments()
    {
        $response = m::mock('GuzzleHttp\Message\Response');
        $results = (object) [
            'payments' => [
                0 => (object) [
                    'id' => 'XXXX',
                    'date' => '2015-04-21T00:59:28Z',
                    'status' => 'refunded',
                    'currency' => 'USD',
                    'amount' => '500',
                    'fee' => '0',
                    'amount_refunded' => '500',
                    'name' => 'karl hughes',
                    'email' => 'khughes.me@gmail.com',
                    'card_last4' => 'XXXX',
                    'card_type' => 'Visa',
                    'card_exp_month' => '4',
                    'card_exp_year' => '2019',
                    'customer_id' => 'XXXX',
                    'form_id' => 'XXXX',
                ]
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'payments', $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($results));

        $payments = $this->moonclerk->getPayments();
        $this->assertEquals($results, $payments);
    }

    public function testItGetsPaymentsWithFilters()
    {
        $form_id = 'XXXX';
        $response = m::mock('GuzzleHttp\Message\Response');
        $results = (object) [
            'payments' => [
                0 => (object) [
                    'id' => 'XXXX',
                    'date' => '2015-04-21T00:59:28Z',
                    'status' => 'refunded',
                    'currency' => 'USD',
                    'amount' => '500',
                    'fee' => '0',
                    'amount_refunded' => '500',
                    'name' => 'karl hughes',
                    'email' => 'khughes.me@gmail.com',
                    'card_last4' => 'XXXX',
                    'card_type' => 'Visa',
                    'card_exp_month' => '4',
                    'card_exp_year' => '2019',
                    'customer_id' => 'XXXX',
                    'form_id' => 'XXXX',
                ]
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'payments?form_id='.$form_id, $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($results));

        $payments = $this->moonclerk->getPayments(['form_id' => $form_id]);
        $this->assertEquals($results, $payments);
    }

    public function testItGetsPaymentById()
    {
        $id = 'XXXX';
        $response = m::mock('GuzzleHttp\Message\Response');
        $result = (object) [
            'payment' => (object) [
                'id' => 'XXXX',
                'date' => '2015-04-21T00:59:28Z',
                'status' => 'refunded',
                'currency' => 'USD',
                'amount' => '500',
                'fee' => '0',
                'amount_refunded' => '500',
                'name' => 'karl hughes',
                'email' => 'khughes.me@gmail.com',
                'card_last4' => 'XXXX',
                'card_type' => 'Visa',
                'card_exp_month' => '4',
                'card_exp_year' => '2019',
                'customer_id' => 'XXXX',
                'form_id' => 'XXXX',
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'payments/'.$id, $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($result));

        $payment = $this->moonclerk->getPayment($id);
        $this->assertEquals($result, $payment);
    }

    public function testItGetsCustomers()
    {
        $response = m::mock('GuzzleHttp\Message\Response');
        $results = (object) [
            'customers' => [
                0 => (object) [
                    'id' => 'XXXX',
                    'name' => 'karl hughes',
                    'email' => 'khughes.me@gmail.com',
                    'card_last4' => 'XXXX',
                    'card_type' => 'Visa',
                    'card_exp_month' => '4',
                    'card_exp_year' => '2019',
                ]
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'customers', $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($results));

        $customers = $this->moonclerk->getCustomers();
        $this->assertEquals($results, $customers);
    }

    public function testItGetsCustomerById()
    {
        $id = 'XXXX';
        $response = m::mock('GuzzleHttp\Message\Response');
        $result = (object) [
            'customer' => (object) [
                'id' => $id,
                'name' => 'karl hughes',
                'email' => 'khughes.me@gmail.com',
                'card_last4' => 'XXXX',
                'card_type' => 'Visa',
                'card_exp_month' => '4',
                'card_exp_year' => '2019',
            ]
        ];

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'customers/'.$id, $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->with(true)
            ->once()
            ->andReturn(json_encode($result));

        $customer = $this->moonclerk->getCustomer($id);
        $this->assertEquals($result, $customer);
    }

    public function testItReturnsErrorWithInvalidApiKey()
    {
        $id = 'XXXX';
        $message = 'Error message will go here';
        $response = m::mock('GuzzleHttp\Message\Response');
        $error = m::mock('\Exception');

        $this->moonclerk->client->shouldReceive('get')
            ->with($this->baseUrl.'customers/'.$id, $this->headers)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('401');
        $error->shouldReceive('getMessage')
            ->once()
            ->andReturn($message);

        $customer = $this->moonclerk->getCustomer($id);
    }

}
