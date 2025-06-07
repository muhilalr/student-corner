<?php

namespace App\Providers;

use App\Models\SubjekMateri;
use App\Models\InformasiMagang;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('subjek_materi', SubjekMateri::all());
            $view->with('info_magang', InformasiMagang::where('slug', 'informasi-magang')->firstOrFail());
        });
        Paginator::useBootstrapFive();
    }
}
