<?php

namespace Tests\Feature\Controllers\BestSellersBooksController;

use App\Services\GoogleBooksApiService;
use Mockery\MockInterface;
use Tests\TestCase;

class ShowMethodTest extends TestCase
{
    private const URI = "/api/bestsellers/books";

    public function test_show_method_returns_success_code()
    {
        $response = $this->get(self::URI . "/9780593449554");

        $response->assertStatus(200);
    }


    public function test_google_books_fetch_method_called_once_in_show_method()
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 200,
                'results' => []
            ], 200)
        ]);

        $this->mock(GoogleBooksApiService::class, function (MockInterface $mock) {
            $mock->shouldReceive('fetch')->once();
        });

        $this->get(self::URI . "/9780593449554");
    }

    /**
     * @dataProvider default_google_books_response
     */
    public function test_show_method_returns_not_empty($responseData)
    {
        \Http::fake([
            'api.nytimes.com/*' => \Http::response([
                'status'  => 200,
                'results' => $responseData
            ], 200)
        ]);

        $response = $this->get(self::URI . "/9780593449554");
        $data = $response->json('data');

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    public function default_google_books_response()
    {
        return [
            [
                [
                    'kind'       => 'books#volume',
                    'id'         => 'OpNdEAAAQBAJ',
                    'etag'       => 'HEcht3BgcWE',
                    'selfLink'   => 'https://www.googleapis.com/books/v1/volumes/OpNdEAAAQBAJ',
                    'volumeInfo' => ['title' => 'Dreamland']
                ]
            ]
        ];
    }
}
