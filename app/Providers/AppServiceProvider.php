<?php

namespace App\Providers;

use App\Models\Link;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(\App\Observers\UserObserver::class);
        Reply::observe(\App\Observers\ReplyObserver::class);
        Topic::observe(\App\Observers\TopicObserver::class);
        Link::observe(\App\Observers\LinkObserver::class);
    }
}
