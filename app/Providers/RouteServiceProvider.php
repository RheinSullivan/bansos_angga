<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path default jika user login.
     * (Tidak digunakan karena kita override redirectTo di LoginController)
     */
    public const HOME = '/home';

    /**
     * Tentukan rute aplikasi.
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Redirect berdasarkan peran user.
     */
    public static function redirectTo()
    {
        if (auth()->user()->role === 'admin') {
            return '/dashboard/admin';
        } elseif (auth()->user()->role === 'masyarakat') {
            return '/dashboard/masyarakat';
        }

        return '/'; // fallback kalau tidak ada role
    }

    /**
     * Rate limiter untuk API.
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
