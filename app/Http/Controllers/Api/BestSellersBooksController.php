<?php

namespace App\Http\Controllers\Api;

use App\Constants\PageItemsNumber;
use App\Http\Controllers\Controller;
use App\Models\JsonResponseModel;
use App\Models\JsonResponseSuccessModel;
use App\Services\GoogleBooksApiService;
use App\Services\NYBestSellersBooksApiService;
use App\Transformers\BestsellersBookListTransformer;
use App\Transformers\BestsellersBookTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BestSellersBooksController extends Controller
{
    /**
     * @param Request                      $request
     * @param string                       $list
     * @param NYBestSellersBooksApiService $apiService
     * @return JsonResponse
     */
    public function index(Request $request, string $list, NYBestSellersBooksApiService $apiService): JsonResponse
    {
        $page = $request->input("page", 1);
        $response = $apiService->fetch([
            "list" => $list,
            "offset" => ($page-1)*PageItemsNumber::NY_BESTSELLERS_BOOKS,
        ]);

        $response["data"] = BestsellersBookListTransformer::transform($response["data"]);

        return JsonResponseModel::success($response);
    }

    /**
     * @param  string $isbn
     * @param  GoogleBooksApiService $apiService
     * @return JsonResponse
     */
    public function show(string $isbn, GoogleBooksApiService $apiService): JsonResponse
    {
        return JsonResponseModel::success(
            BestsellersBookTransformer::transform($apiService->fetch(["q" => "isbn:{$isbn}"]), ["isbn" => $isbn])
        );
    }
}
