<?php

namespace Spits\LaravelOpenproviderApi\Http\Controllers;

use Illuminate\Http\Request;
use Spits\LaravelOpenproviderApi\Services\DomainService;

class DomainController
{
    public function show(int $id, DomainService $domainService)
    {
        $options = [];
        $response = $domainService->getDomain($id);

        return $response->collect();
    }

    public function update(Request $request, int $id, DomainService $domainService)
    {
        $data = $request->data;
        $response = $domainService->updateDomain($id, $data);

        return $response;
    }
}
