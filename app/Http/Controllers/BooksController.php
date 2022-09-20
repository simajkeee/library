<?php

namespace App\Http\Controllers;

use App\Mappers\BookMapper;
use App\Services\NYBestSellersBooksApiService;

class BooksController extends Controller
{
    public function index(NYBestSellersBooksApiService $apiService, BookMapper $mapper)
    {
        $results = $apiService->fetch()->json('results');

        $details = array_column($results, 'book_details');

        return view("books.index", ['books' => $mapper->mapList(array_column($details, 0))]);
    }
}
