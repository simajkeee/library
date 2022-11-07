<?php

use App\Http\Controllers\Api\BestSellersListsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'books', 'as' => 'books.'], function () {
    Route::get('{list}', 'BestSellersBooksController@index')
        ->where(['list' => '[A-Za-z-]+'])
        ->name('list');

    Route::get('{isbn13}', 'BestSellersBooksController@show')
        ->where(['isbn13' => '[0-9]{13}'])
        ->name('book');
});
