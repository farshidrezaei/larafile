<?php

namespace FarshidRezaei\Larafile\Providers;

use FarshidRezaei\LaraFile\Http\Middleware\EnsureRootDirectoryExists;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The controller namespace for the package.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'FarshidRezaei\\LaraFile\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $middleware = [ 'api', ...config('larafile.middleware', [])];

        $this->routes(
            function () use ($middleware) {
                Route::prefix(config('larafile.routePrefix', 'larafile') . '/api')
                    ->middleware($middleware)
                    ->namespace($this->namespace)
                    ->group(
                        function () {
                            Route::namespace('Navigation')
                                ->group(__DIR__ . '/../Routes/navigation.php');
                        }
                    );


//                Route::prefix(config('larafile.routePrefix', 'larafile'))
//                    ->middleware('web')
//                    ->namespace($this->namespace)
//                    ->group(__DIR__ . '/../Routes/web.php');
            }
        );
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for(
            'api',
            function (Request $request) {
                return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
            }
        );
    }
}
