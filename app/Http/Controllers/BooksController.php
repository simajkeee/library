<?php

namespace App\Http\Controllers;


use App\Mappers\BookMapper;
use App\Services\NYBestSellersBooksApiService;

class BooksController extends Controller
{

    public function index(NYBestSellersBooksApiService $apiService, BookMapper $mapper)
    {
        $response = $apiService->fetch()->json();

        $listBookDetails = array_column($response['results'] ?? [], 'book_details');
        $results = [];
        foreach ($listBookDetails as $bookDetail) {
            $results[] = $mapper->map($bookDetail[0] ?? []);
        }

        return view("books.index", ['books' => $results]);
    }

    public function show()
    {

    }
}
