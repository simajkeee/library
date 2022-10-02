<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mappers\BookMapper;
use App\Models\JsonResponseModel;
use App\Models\JsonResponseSuccessModel;
use App\Services\GoogleBooksApiService;
use App\Services\NYBestSellersBooksApiService;
use App\Transformers\BestsellersBookListTransformer;
use Illuminate\Http\JsonResponse;

class BooksController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(string $list, NYBestSellersBooksApiService $apiService): JsonResponse
    {
        return JsonResponseModel::success(
            BestsellersBookListTransformer::transform($apiService->fetch(['list' => $list]))
        );
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * @param  string  $isbn10
     * @return JsonResponse
     */
    public function show(string $isbn10, GoogleBooksApiService $apiService): JsonResponse
    {
        return JsonResponseModel::success($apiService->fetch(['q' => "isbn:{$isbn10}"]));
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}
