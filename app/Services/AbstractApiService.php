<?php

namespace App\Services;

use App\Interfaces\Fetchable;
use Illuminate\Http\Client\Response;

abstract class AbstractApiService implements Fetchable
{
    protected array $allowedParams = [];

    protected function filterParams(array $passedParams): array
    {
        if (!$this->allowedParams) {
            return $passedParams;
        }
        return array_filter($passedParams, fn($key) => in_array($key, $this->allowedParams),ARRAY_FILTER_USE_KEY);
    }

    abstract public function fetch(array $params): Response;
}
