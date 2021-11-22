<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::directive('money', function ($expression) {
            return "<?php echo $expression ?>";
        });

        $this->app->bind(
            'App\Contracts\Admin\Cotizaciones\CreatesCotizaciones',
            'App\Actions\Admin\Cotizaciones\CreateCotizacion'
        );

        $this->app->bind(
            'App\Contracts\Admin\Cotizaciones\DeletesCotizaciones',
            'App\Actions\Admin\Cotizaciones\DeleteCoti'
        );

        $this->app->bind(
            'App\Contracts\Admin\Cotizaciones\UpdatesCotizaciones',
            'App\Actions\Admin\Cotizaciones\UpdateCotizacion'
        );

    }
}
