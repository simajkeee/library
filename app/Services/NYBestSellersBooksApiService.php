<?php

namespace App\Services;

use App\Interfaces\ApiService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class NYBestSellersBooksApiService implements ApiService
{
    private const API_URL = "https://api.nytimes.com/svc/books/v3/lists.json";

    private array $defaultParams = [
        'list' => 'hardcover-fiction',
    ];

    public function __construct()
    {
        $apiKey = config('services.ny_times.key');
        if (!$apiKey) {
            throw new Exception(\ExceptionMessage::noApiKey(self::class));
        }
        $this->defaultParams['api-key'] = $apiKey;
    }

    public function fetch(array $params = []): Response
    {
        return Http::get(self::API_URL, array_merge(
                $this->defaultParams,
                $params,
            )
        )->throw();
    }
}
