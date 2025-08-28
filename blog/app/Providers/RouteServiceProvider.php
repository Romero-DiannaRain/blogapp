<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Http\Middleware\StudentAuth;
use App\Http\Middleware\RedirectIfStudentLoggedIn;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/posts';

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register route middleware aliases
        Route::aliasMiddleware('student.auth', StudentAuth::class);

        $this->routes(function () {
            // Web routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // API routes
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
