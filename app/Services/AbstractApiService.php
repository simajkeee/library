<?php

namespace App\Services;

use App\Interfaces\Fetchable;
use Illuminate\Http\Client\Response;

abstract class AbstractApiService implements Fetchable
{
    protected function filterParams(array $allowedKeys, array $passedParams): array
    {
        return array_filter($passedParams, fn($key) => isset($allowedKeys[$key]),ARRAY_FILTER_USE_KEY);
    }

    abstract public function fetch(array $params): Response;
}
