<?php

namespace Tests\Unit\Services\ThirdParty;

use App\Interfaces\Fetchable;
use App\Services\NYBestSellersListsApiService;
use Tests\TestCase;

class NYBestSellersListsApiServiceTest extends TestCase
{
    protected NYBestSellersListsApiService $nyBestSellersService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->nyBestSellersService = app()->make(NYBestSellersListsApiService::class);
    }

    public function test_empty_api_key_argument_exception()
    {
        $this->expectException("\Exception");
        app()->make(NYBestSellersListsApiService::class, ['apiKey' => '']);
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
