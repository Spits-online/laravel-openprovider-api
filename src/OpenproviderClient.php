<?php

namespace Spits\LaravelOpenproviderApi;

use Illuminate\Support\Facades\Http;

class OpenproviderClient
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('openprovider-api.base_url'))
            ->acceptJson()
            ->withHeaders(array_merge(OpenproviderAuth::getAuthorization(), []));
    }

    public function get($suffix, array $options = [])
    {
        $response = $this->httpClient->get($suffix, $options);

        return $response;
    }

    public function put(string $url, array $data = [])
    {
        $response = $this->httpClient->put($url, $data);

        return $response;
    }
}
