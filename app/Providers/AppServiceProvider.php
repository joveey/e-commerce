<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <-- Tambahkan ini
use App\Http\View\Composers\CartComposer; // <-- Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Daftarkan View Composer untuk semua view
        // Tanda '*' berarti composer ini akan dijalankan untuk setiap view yang dirender.
        // Ini memastikan $cartItemCount selalu tersedia di layout Anda.
        View::composer('*', CartComposer::class);
    }
}