<?php

namespace App\Services;

use App\Interfaces\ParamsAllowableApiService;
use App\Messages\Exceptions\ApiExceptionMessages;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class NYBestSellersBooksApiService extends AbstractApiService
{
    private const API_URL = "https://api.nytimes.com/svc/books/v3/lists.json";

    protected array $defaultParams = [
        'list' => 'hardcover-fiction',
    ];

    protected array $allowedParams = [
        'list',
        'bestsellers-date',
        'published-date',
        'offset',
    ];

    public function __construct(string $apiKey)
    {
        if (!$apiKey) {
            throw new Exception(ApiExceptionMessages::noApiKey(self::class));
        }
        $this->defaultParams['api-key'] = $apiKey;
    }

    /**
     * @param array $params
     * @return array
     * @throws RequestException
     */
    public function fetch(array $params = []): array
    {
        return $this->get($this->filterParams($params));
    }

    protected function get(array $params = [])
    {
        return Http::get(self::API_URL, array_merge($this->defaultParams, $params))
                   ->throw()
                   ->json('results') ?: [];
    }
}
