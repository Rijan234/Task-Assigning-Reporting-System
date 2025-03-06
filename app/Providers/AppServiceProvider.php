<?php

namespace App\Providers;

use App\Http\View\Composers\UserComposer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as FacadesView;
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
               // Register the view composer to share data with all views
               FacadesView::composer('*', UserComposer::class);
    }
}
