<?php

namespace App\Providers;
use App\Models\Program;
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
        View::composer(['*'], function ($view) {
            // Ambil program ringkas aja (id & title) biar ringan
            $programsNav = Program::where('is_active', true)->select('id', 'title')->get();
            $view->with('programsNav', $programsNav);
        });
    }
}
