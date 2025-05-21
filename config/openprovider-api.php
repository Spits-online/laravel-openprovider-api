<?php

return [
    'base_url' => env('OPENPROVIDER_BASE_URL', "https://api.openprovider.eu/v1beta"),
    // IP address of the server that will make requests to the Openprovider API
    'ip' => env('OPENPROVIDER_IP'),
    'username' => env('OPENPROVIDER_USERNAME'),
    'password' => env('OPENPROVIDER_PASSWORD'),
    'middleware' => [],
];
