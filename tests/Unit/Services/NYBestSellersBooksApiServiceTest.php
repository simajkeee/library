<?php

namespace Services;

use App\Interfaces\Fetchable;
use App\Services\NYBestSellersBooksApiService;
use Tests\TestCase;
use function app;

class NYBestSellersBooksApiServiceTest extends TestCase
{
    protected NYBestSellersBooksApiService $nyBestSellersService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->nyBestSellersService = app()->make(NYBestSellersBooksApiService::class);
    }

    public function test_empty_api_key_argument_exception()
    {
        $this->expectException("\Exception");
        app()->make(NYBestSellersBooksApiService::class, ['apiKey' => '']);
    }

    public function test_implements_fetchable_interface()
    {
        $this->assertInstanceOf(Fetchable::class, $this->nyBestSellersService);
    }

    public function test_fetch_method_returns_array()
    {
        $responseArray = $this->nyBestSellersService->fetch();

        $this->assertNotEmpty($responseArray);
        $this->assertIsArray($responseArray);
    }
}
