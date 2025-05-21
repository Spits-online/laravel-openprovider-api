<?php

namespace Spits\LaravelOpenproviderApi;

use Exception;
use Illuminate\Support\Facades\Http;

class OpenproviderAuth
{
    protected const CACHE_KEY = 'openprovider-auth-token';

    protected const CACHE_LIFETIME = 8 * 60 * 60;

    public static function getAuthorization()
    {
        return [
            'Authorization' => sprintf('Bearer %s', self::getBearerToken()),
        ];
    }

    public static function getBearerToken(): ?string
    {
        if (cache()->has(self::CACHE_KEY)) {
            return cache()->get(self::CACHE_KEY)['token'];
        }

        return self::makeAuthRequest();

    }

    protected static function makeAuthRequest(): ?string
    {
        $request = Http::asJson()
            ->post(sprintf('%s/auth/login', config('openprovider-api.base_url')), [
                'ip' => config('openprovider-api.ip'),
                'username' => config('openprovider-api.username'),
                'password' => config('openprovider-api.password'),
            ]);

        if (! $request->ok()) {
            throw new Exception($request->collect()->get('desc'), $request->collect()->get('code'));
        }

        $token = $request->collect('data')->toArray();
        cache()->put(static::CACHE_KEY, $token, static::CACHE_LIFETIME);

        return $token['token'];
    }
}
