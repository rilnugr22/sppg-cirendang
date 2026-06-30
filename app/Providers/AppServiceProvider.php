<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- 1. WAJIB IMPORT INI

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
        // 2. Paksa Laravel menggunakan HTTPS jika berjalan di server production (Railway)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
