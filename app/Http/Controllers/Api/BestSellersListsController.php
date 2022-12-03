<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JsonResponseModel;
use App\Services\NYBestSellersListsApiService;
use Illuminate\Http\JsonResponse;

class BestSellersListsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  NYBestSellersListsApiService $apiService
     * @return JsonResponse
     */
    public function __invoke(NYBestSellersListsApiService $apiService): JsonResponse
    {
        return JsonResponseModel::success($apiService->fetch());
    }
}
