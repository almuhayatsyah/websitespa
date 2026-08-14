<?php

namespace App\Providers;

use App\Models\Pengaturan;
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
        // Share $setting globally to all views (for navbar, footer, FAB)
        View::composer('*', function ($view) {
            try {
                $setting = Pengaturan::getSetting();
            } catch (\Exception $e) {
                // Fallback if DB not yet migrated
                $setting = new Pengaturan();
            }
            $view->with('setting', $setting);
        });
    }
}
