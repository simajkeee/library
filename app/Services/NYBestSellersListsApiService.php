<?php

namespace App\Services;

use App\Messages\Exceptions\ApiExceptionMessages;
use Illuminate\Support\Facades\Http;

class NYBestSellersListsApiService extends AbstractApiService
{
    private const API_URL = "https://api.nytimes.com/svc/books/v3/lists/names.json";

    public function __construct(string $apiKey)
    {
        if (!$apiKey) {
            throw new \Exception(ApiExceptionMessages::noApiKey(self::class));
        }
        $this->defaultParams['api-key'] = $apiKey;
    }

    public function fetch(array $params = []): array
    {
        return $this->get($this->filterParams($params));
    }

    protected function get(array $params = [])
    {
        return Http::get(static::API_URL, array_merge($this->defaultParams, $params))
                      ->throw()
                      ->json('results');
    }

}
