<?php

namespace Spits\LaravelOpenproviderApi\Services;

use Spits\LaravelOpenproviderApi\OpenproviderClient;

class DomainService
{
    protected $client;

    public function __construct()
    {
        $this->client = new OpenproviderClient;
    }

    public function getDomains(array $options = [])
    {
        $response = $this->client->get('/domains', $options);

        return $response;
    }

    public function getDomain(int $openproviderId)
    {
        $response = $this->client->get('/domains/'.$openproviderId);

        return $response;
    }

    public function updateDomain(int $domainId, array $data = [])
    {
        $response = $this->client->put('/domains/'.$domainId, $data);

        return $response;
    }
}
