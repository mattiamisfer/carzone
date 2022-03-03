<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;


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
    public function boot(Guard $auth)
    {
        //
        // Schema::defaultStringLength(191);

         $categories = Category::all();
       
        view()->share('categories',$categories);
        View::composer('*', function ($view) use ($auth) {
            $view->with('currentAuthenticatedUser', $auth->user());
        });
        
           
       
    }
}
