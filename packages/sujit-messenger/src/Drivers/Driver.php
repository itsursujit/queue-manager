<?php


namespace Sujit\Messenger\Drivers;


use Sujit\Messenger\Http\Curl;
use Sujit\Messenger\Models\VendorService;

abstract class Driver
{
    public $token;

    public $extraFields;
    /**
     * @var VendorService
     */
    public $service;

    public $vendor;

    public function withVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function withService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function auth()
    {
        switch($this->service->auth_type)
        {
            case 'basic':
                $this->handleBasicAuth();
                break;
            default:
                break;
        }
        return $this;
    }

    public function handleBasicAuth()
    {
        $url = $this->service->auth_url;
        $extraFields = json_decode($this->service->auth_extra_fields, true);
        $headers = json_decode($this->service->auth_headers, true);
        $credentials = json_decode($this->service->credentials, true);
        $token = base64_encode(implode(':', array_values($credentials)));
        $headers[] = 'Authorization: Basic ' . $token;
        $client = new Curl();
        $response = json_decode($client->post($url, $extraFields, $headers)->body, true);
        if(isset($response['access_token']) && $this->service->use_generated_token_for_auth)
        {
            $this->token = $response['access_token'];
        }
        return $response;
    }

    public function send($payload)
    {
        if(!$this->service->allow_sending)
        {
            throw new \Exception('Sending is not allowed for this service');
        }
        $url = $this->service->message_sending_url;
        $headers = json_decode($this->service->message_sending_headers, true);
        if($this->service->use_generated_token_for_auth && $this->token)
        {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }
        $client = new Curl();
        $response = $client->post($url, $payload, $headers);
        return $response;
    }

    public function receive()
    {

    }
}
