<?php

namespace App\Providers;

use App\Services\Interfaces\ProfileServiceInterface;
use App\Services\ProfileService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
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
    }
}
