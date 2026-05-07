<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme; // Pakai yang ini, jangan yang lama

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gate buat tugas ekspor
        Gate::define('export-product', function (User $user) {
            return $user->isAdmin();
        });

        // Konfigurasi Scramble
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            })
            ->afterOpenApiGenerated(function (OpenApi $openApi) {
                // Ini cara paling aman buat manggil Bearer Token (Gembok)
                $openApi->secure(SecurityScheme::http('bearer'));
            });

        // Izin akses dokumen
        Gate::define('viewApiDocs', function (?User $user) {
            return true;
        });
    }
}