<?php

namespace App\Providers;

use App\Services\CommentService;
use App\Services\Interfaces\CommentServiceInterface;
use App\Services\Interfaces\PostServiceInterface;
use App\Services\Interfaces\ProfileServiceInterface;
use App\Services\PostService;
use App\Services\ProfileService;
use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProfileServiceInterface::class,
            ProfileService::class
        );

        $this->app->bind(
            PostServiceInterface::class,
            PostService::class
        );

        $this->app->bind(
            CommentServiceInterface::class,
            CommentService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
