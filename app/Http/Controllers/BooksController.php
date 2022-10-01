<?php

namespace App\Http\Controllers;

use App\Mappers\BookMapper;
use App\Services\NYBestSellersBooksApiService;

class BooksController extends Controller
{
    public function index(NYBestSellersBooksApiService $apiService, BookMapper $mapper)
    {
        return view("books.index", ['books' => $mapper->mapList($apiService->fetch())]);
    }
}
