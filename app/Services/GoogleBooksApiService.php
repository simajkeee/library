<?php

namespace App\Services;

use App\Messages\Exceptions\ApiExceptionMessages;

class GoogleBooksApiService extends AbstractApiService
{
    public function __construct(string $apiKey)
    {
        if (!$apiKey) {
            throw new \Exception(ApiExceptionMessages::noApiKey(self::class));
        }
        $this->defaultParams['api-key'] = $apiKey;
    }

    public function fetch(array $params = []): array
    {
        return [];
    }
}
