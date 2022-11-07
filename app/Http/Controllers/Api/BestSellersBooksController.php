<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JsonResponseModel;
use App\Models\JsonResponseSuccessModel;
use App\Services\GoogleBooksApiService;
use App\Services\NYBestSellersBooksApiService;
use App\Transformers\BestsellersBookListTransformer;
use Illuminate\Http\JsonResponse;

class BestSellersBooksController extends Controller
{
    /**
     * @param  string $list
     * @param  NYBestSellersBooksApiService $apiService
     * @return JsonResponse
     */
    public function index(string $list, NYBestSellersBooksApiService $apiService): JsonResponse
    {
        return JsonResponseModel::success(
            BestsellersBookListTransformer::transform($apiService->fetch(['list' => $list]))
        );
    }

    /**
     * @param  string $isbn13
     * @param  GoogleBooksApiService $apiService
     * @return JsonResponse
     */
    public function show(string $isbn13, GoogleBooksApiService $apiService): JsonResponse
    {
        return JsonResponseModel::success($apiService->fetch(['q' => "isbn:{$isbn13}"]));
    }
}
