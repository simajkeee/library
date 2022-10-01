<?php

namespace Controllers;

use App\Services\NYBestSellersBooksApiService;
use Mockery\MockInterface;
use Tests\TestCase;

class BooksControllerTest extends TestCase
{
    /**
     * @dataProvider index_method_returns_success_code
     */
    public function test_index_method_returns_success_code(int $status, array $results)
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => $status,
                'results' => $results
            ], $status)
        ]);

        $response = $this->get('/api/books/list/bestsellers/hardcover-fiction');

        $response->assertStatus(200);
    }

    public function test_show_method_returns_success_code()
    {
        $response = $this->get('/api/books/list/bestsellers/book/059344955X');

        $response->assertStatus(200);
    }

    /**
     * @dataProvider ny_best_sellers_fetch_method_called_once_in_index_method
     */
    public function test_ny_best_sellers_fetch_method_called_once_in_index_method(int $status, array $results)
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => $status,
                'results' => $results
            ], $status)
        ]);

        $this->mock(NYBestSellersBooksApiService::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetch')->once();
        });

        $this->get('/api/books/list/bestsellers/hardcover-fiction');
    }

    /**
     * @dataProvider ny_best_sellers_api_service_fetch_method_returns_error_code_in_index_method
     */
    public function test_ny_best_sellers_fetch_method_returns_error_code_in_index_method($status, $results)
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => $status,
                'results' => $results
            ], $status)
        ]);

        $response = $this->get('/api/books/list/bestsellers/hardcover-fiction');

        $response->assertStatus(500);
    }

    public function ny_best_sellers_api_service_fetch_method_returns_error_code_in_index_method()
    {
        return [
            [400, []]
        ];
    }

    public function ny_best_sellers_fetch_method_called_once_in_index_method()
    {
        return [
            [200, []]
        ];
    }

    public function index_method_returns_success_code()
    {
        return [
            [
                200,
                [
                    [ // 1 item
                        'list_name'        => 'Hardcover Fiction',
                        'display_name'     => 'Hardcover Fiction',
                        'bestsellers_date' => '2022-09-17',
                        'published_date'   => '2022-10-02',
                        'isbns'            => [
                            [
                                'isbn10' => '',
                                'isbn13' => '',
                            ],
                        ],
                        'book_details'     => [
                            [
                                'title'            => 'FAIRY TALE',
                                'description'      => 'A high school kid inherits a shed that is a portal to another world where good and evil are at war.',
                                'contributor'      => 'by Stephen King',
                                'author'           => 'Stephen King',
                                'contributor_note' => '',
                                'price'            => '0.00',
                                'age_group'        => '',
                                'publisher'        => 'Scribner',
                                'primary_isbn13'   => '9781668002179',
                                'primary_isbn10'   => '1668002175',
                            ],
                        ],
                    ]
                ]
            ]
        ];
    }
}
