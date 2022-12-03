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

Route::group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'bestsellers', 'as' => 'books.'], function () {
    Route::get('/lists', BestSellersListsController::class);

    Route::get('/lists/{list}', 'BestSellersBooksController@index')
        ->where(['list' => '[A-Za-z-]+'])
        ->name('single-list');

    Route::get('/books/{isbn}', 'BestSellersBooksController@show')
        ->where(['isbn' => '[0-9a-zA-z]{10,13}'])
        ->name('book');
});
