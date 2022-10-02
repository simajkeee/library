<?php

namespace App\Services;

use App\Messages\Exceptions\ApiExceptionMessages;
use Illuminate\Support\Facades\Http;

class GoogleBooksApiService extends AbstractApiService
{
    private const API_URL = 'https://www.googleapis.com/books/v1/volumes';

    protected array $allowedParams = ['q'];

    protected array $requiredParams = ['q'];

    public function __construct(string $apiKey)
    {
        if (!$apiKey) {
            throw new \Exception(ApiExceptionMessages::noApiKey(self::class));
        }
        $this->defaultParams['api-key'] = $apiKey;
    }

    public function fetch(array $params = []): array
    {
        return $this->checkRequiredParams($params)->get($this->filterParams($params));
    }

    protected function get(array $params = []): array
    {
        return Http::get(static::API_URL, array_merge($this->defaultParams, $params))
                   ->throw()
                   ->json('items');
    }
}
