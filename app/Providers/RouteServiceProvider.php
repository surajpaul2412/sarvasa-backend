<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin/gold-rates'; // Redirect after login

    public function boot(): void
    {
        parent::boot(); // Ensure parent boot method is called

        $this->routes(function () {
            // ✅ Load API routes correctly
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            // ✅ Load Web routes correctly
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
