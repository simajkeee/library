<?php

namespace Controllers\BooksController;

use App\Services\NYBestSellersBooksApiService;
use Mockery\MockInterface;
use Tests\TestCase;

class IndexMethodTest extends TestCase
{
    /**
     * @dataProvider index_method_returns_success_code
     */
    public function test_index_method_returns_success_code(array $results)
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 200,
                'results' => $results
            ], 200)
        ]);

        $response = $this->get('/api/books/list/bestsellers/hardcover-fiction');

        $response->assertStatus(200);
    }

    public function test_ny_best_sellers_fetch_method_called_once_in_index_method()
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 200,
                'results' => []
            ], 200)
        ]);

        $this->mock(NYBestSellersBooksApiService::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetch')->once();
        });

        $this->get('/api/books/list/bestsellers/hardcover-fiction');
    }

    public function test_ny_best_sellers_fetch_method_returns_error_code_in_index_method()
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 400,
                'results' => []
            ], 400)
        ]);

        $response = $this->get('/api/books/list/bestsellers/hardcover-fiction');

        $response->assertStatus(500);
    }

    public function index_method_returns_success_code()
    {
        return [
            [
                [
                    [
                        'list_name'        => 'Hardcover Fiction',
                        'display_name'     => 'Hardcover Fiction',
                        'bestsellers_date' => '2022-09-17',
                        'published_date'   => '2022-10-02',
                        'book_details'     => [
                            [
                                'title'       => 'FAIRY TALE',
                                'description' => 'A high school kid inherits a shed that is a portal to another world where good and evil are at war.',
                                'contributor' => 'by Stephen King',
                                'author'      => 'Stephen King',
                            ],
                        ],
                    ]
                ]
            ]
        ];
    }
}
