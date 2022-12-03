<?php

namespace Controllers\BestSellersListsController;

use App\Services\NYBestSellersListsApiService;
use Mockery\MockInterface;
use Tests\TestCase;

class InvokeMethodTest extends TestCase
{

    private const URI = "/api/bestsellers/lists";

    /**
     * @dataProvider invoke_method_returns_success_code
     */
    public function test_invoke_method_returns_success_code(array $results)
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 200,
                'results' => $results
            ], 200)
        ]);

        $response = $this->get(self::URI);

        $response->assertStatus(200);
    }

    public function test_ny_best_sellers_lists_fetch_method_called_once_in_index_method()
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 200,
                'results' => []
            ], 200)
        ]);

        $this->mock(NYBestSellersListsApiService::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetch')->once();
        });

        $this->get(self::URI);
    }

    public function test_ny_best_sellers_lists_fetch_method_returns_error_code_in_invoke_method()
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 400,
                'results' => []
            ], 400)
        ]);

        $response = $this->get(self::URI);

        $response->assertStatus(500);
    }

    public function invoke_method_returns_success_code()
    {
        return [
            [
                [
                    [
                        "list_name"             => "Combined Print and E-Book Fiction",
                        "display_name"          => "Combined Print & E-Book Fiction",
                        "list_name_encoded"     => "combined-print-and-e-book-fiction",
                        "oldest_published_date" => "2011-02-13",
                        "newest_published_date" => "2022-11-13",
                        "updated"               => "WEEKLY"
                    ]
                ]
            ]
        ];
    }
}
