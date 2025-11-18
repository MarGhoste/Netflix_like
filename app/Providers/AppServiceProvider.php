<?php

namespace App\Providers;

use App\View\Composers\GenreComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Vincula el GenreComposer a la vista del sidebar.
        // Esto asegura que la variable '$sidebarGenres' siempre estará disponible en esa vista.
        View::composer('components.app.sidebar', GenreComposer::class);
    }
}
