<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')){
            $this->app->register(DuskServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer( ["layouts.layout", "layouts.category_layout"], function ($view)
        {
            $categories = Category::all();
            $view->with('categories', $categories);
        });

        view()->composer('layouts.sidebar', function ($view){
           $view->with('popular_posts', Post::orderBy('views', 'desc')->limit(3)->get());
           $view->with('cats', Category::withCount('posts')->orderBy('posts_count','desc')->get());
        });
    }
}
