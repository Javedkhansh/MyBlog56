<?php

namespace App\Providers;

use App\Blog;
use Illuminate\Support\ServiceProvider;
use View; 
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // view::composer('layouts.app', function($view){
        //     $view->with('blogs', Blog::all());
        // });

        view::composer(['partials.meta_dynamic','layouts.nav'], function($view){
            //show all blogs that published or unpublished
            // $view->with('blogs', Blog::all());

            //show and only published blogs
            $view->with('blogs', Blog::where('status',1)->latest()->get());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
