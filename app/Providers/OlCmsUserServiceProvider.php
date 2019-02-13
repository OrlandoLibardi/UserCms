<?php

namespace OrlandoLibardi\UserCms\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class OlCmsUserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Rotas
        Route::namespace('OrlandoLibardi\UserCms\app\Http\Controllers')
        ->middleware(['auth'])
        ->prefix(['admin'])
        ->group(__DIR__. '../../routes/web.php');

        //registrar as views
        $this->loadViewsFrom( __DIR__.'/../../resources/views/', 'viewUserCms');
        //publicar os arquivos
        $this->publishes([
            __DIR__.'/../../resources/views/' => resource_path('admin/'),
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
            __DIR__.'/../../database/factories/' => database_path('factories'),
            __DIR__.'/../../database/seeds/' => database_path('seeds'),
        ],'adminUser');

        
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}