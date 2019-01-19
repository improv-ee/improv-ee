<?php

namespace App\Providers;

use App\Orm\Organization;
use App\Orm\Production;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('organization', function ($value) {
            return Organization::whereTranslation('slug', $value)->first() ?? abort(404);
        });

        Route::bind('production', function ($value) {
            return Production::whereTranslation('slug', $value)->first() ?? abort(404);
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        Route::get('/health', function () {
            return 'OK';
        });

        Route::domain(env('API_DOMAIN'))
            ->get('/', function () {
                return response()->json([
                    "title" => "improvision.eu API",
                    "doc" => "https://docs.improvision.eu",
                    "homepage" => "https://improvision.eu"
                ]);
            });


        $this->mapApiRoutes();

        $this->mapWebRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::domain(env('WEB_DOMAIN'))
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::domain(env('API_DOMAIN'))
            ->prefix('v1')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
