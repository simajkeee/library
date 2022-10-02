<?php

namespace Services;

use App\Interfaces\Fetchable;
use App\Services\GoogleBooksApiService;
use Tests\TestCase;

class GoogleBooksApiServiceTest extends TestCase
{
    protected GoogleBooksApiService $googleBooksApiService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->googleBooksApiService = app()->make(GoogleBooksApiService::class);
    }

    public function test_empty_api_key_argument_exception()
    {
        $this->expectException("\Exception");
        app()->make(GoogleBooksApiService::class, ['apiKey' => '']);
    }

    public function test_implements_fetchable_interface()
    {
        $this->assertInstanceOf(Fetchable::class, $this->googleBooksApiService);
    }

    public function test_fetch_method_returns_array()
    {
        $responseArray = $this->googleBooksApiService->fetch();

        $this->assertNotEmpty($responseArray);
        $this->assertIsArray($responseArray);
    }
}
