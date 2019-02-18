<?php

namespace OrlandoLibardi\UserCms\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class OlCmsUserServiceProvider extends ServiceProvider
{

    protected $commands = [
        'OrlandoLibardi\UserCms\app\Console\Commands\UserOlCmsCommand',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Rotas
        Route::namespace('OrlandoLibardi\UserCms\app\Http\Controllers\Admin')
        ->middleware(['web', 'auth'])
        ->prefix('admin')
        ->group(__DIR__. '/../../routes/web.php');

        //registrar as views
        //$this->loadViewsFrom( __DIR__.'/../../resources/views/admin/', 'viewUserCms');
        //publicar os arquivos
        $this->publishes([
            __DIR__.'/../../resources/views/admin/' => resource_path('views/admin/'),
            __DIR__.'/../../resources/views/auth/' => resource_path('views/auth/'),
            __DIR__.'/../../database/seeds/' => database_path('seeds'),
            __DIR__.'/../../app/User.php' => app_path('/User.php'),
        ],'adminUser');

        
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}