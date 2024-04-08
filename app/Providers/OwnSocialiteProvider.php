<?php

namespace App\Providers;


use App\Services\OwnSocialiteManager;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;


class OwnSocialiteProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(OwnFactory::class, function ($app) {
            return new OwnSocialiteManager($app);
        });
    }


    public function provides(): array
    {
        return [OwnFactory::class];
    }
}
