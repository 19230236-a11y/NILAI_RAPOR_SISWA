<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Program;

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
        //
        Paginator::useBootstrapFive();
        
        // Share programs data with sidebar component
        View::composer('components.sidebar', function ($view) {
            try {
                $programs = Program::orderBy('name')->get();
            } catch (\Exception $e) {
                $programs = collect([]);
            }
            $view->with('programs', $programs);
        });
    }
}
