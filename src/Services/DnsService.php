<?php

namespace Spits\LaravelOpenproviderApi\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Spits\LaravelOpenproviderApi\OpenproviderClient;

class DnsService
{
    protected $client;

    public function __construct()
    {
        $this->client = new OpenproviderClient;
    }

    public function getDnsZone(string $domain, array $options = [])
    {
        $response = $this->client->get('/dns/zones/'.$domain, $options);

        return $response;
    }

    public function updateDnsZone(string $domain, array $data = []): PromiseInterface|Response
    {
        return $this->client->put('/dns/zones/'.$domain, $data);
    }
}
