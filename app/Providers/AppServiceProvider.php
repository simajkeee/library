<?php

namespace App\Providers;

use App\Services\GoogleBooksApiService;
use App\Services\NYBestSellersBooksApiService;
use App\Services\NYBestSellersListsApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(NYBestSellersBooksApiService::class)
                  ->needs('$apiKey')
                  ->giveConfig('services.ny_times.key');

        $this->app->when(NYBestSellersListsApiService::class)
                  ->needs('$apiKey')
                  ->giveConfig('services.ny_times.key');

        $this->app->when(GoogleBooksApiService::class)
                  ->needs('$apiKey')
                  ->giveConfig('services.google_books.key');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
