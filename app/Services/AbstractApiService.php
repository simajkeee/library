<?php

namespace App\Services;

use App\Exceptions\HttpBadParamsExceptions;
use App\Interfaces\Fetchable;
use App\Messages\Exceptions\ApiExceptionMessages;

abstract class AbstractApiService implements Fetchable
{
    protected array $allowedParams = [];

    protected array $requiredParams = [];

    protected array $defaultParams = [];

    protected function filterParams(array $passedParams): array
    {
        if (!$this->allowedParams) {
            return $passedParams;
        }
        return array_filter($passedParams, fn($key) => in_array($key, $this->allowedParams), ARRAY_FILTER_USE_KEY);
    }

    protected function checkRequiredParams(array $params): self
    {
        $missedRequiredParams = $this->getMissedParams($params);
        if (count($missedRequiredParams) > 0) {
            throw new HttpBadParamsExceptions(ApiExceptionMessages::requiredParams($missedRequiredParams));
        }

        return $this;
    }

    protected function getMissedParams(array $params): array
    {
        return array_diff($this->requiredParams, array_keys($params));
    }

    abstract protected function get(array $params = []);

    abstract public function fetch(array $params = []): array;
}
