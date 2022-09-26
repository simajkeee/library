<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mappers\BookMapper;
use App\Models\JsonResponseSuccessModel;
use App\Services\NYBestSellersBooksApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $list, NYBestSellersBooksApiService $apiService, BookMapper $mapper)
    {
        $results = $apiService->fetch(['list' => $list])->json('results') ?: [];

        return JsonResponseSuccessModel::jsonResponse($mapper->mapList($results), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
