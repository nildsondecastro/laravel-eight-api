<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\ApisConfigRepository::class, \App\Repositories\ApisConfigRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ApisConfigsRepository::class, \App\Repositories\ApisConfigsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TesteLaravelapiRepository::class, \App\Repositories\TesteLaravelapiRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LaravelapiTesteRepository::class, \App\Repositories\LaravelapiTesteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LaravelapiTestesRepository::class, \App\Repositories\LaravelapiTestesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PostsRepository::class, \App\Repositories\PostsRepositoryEloquent::class);
        //:end-bindings:
    }
}
