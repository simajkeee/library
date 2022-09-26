<?php

namespace Tests\Unit;

use App\Services\NYBestSellersBooksApiService;
use PHPUnit\Framework\TestCase;

class NYApiServicesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_empty_api_key_argument_exception_of_ny_best_seller_api_service()
    {

        $this->expectException("\Exception");
        app()->make(NYBestSellersBooksApiService::class, ['apiKey' => '']);
    }
}
