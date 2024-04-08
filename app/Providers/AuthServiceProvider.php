<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Reply;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Horizon\Horizon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
	    //Reply::class => \App\Policies\ReplyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Horizon::auth(function ($request) {
            // 是否是站长
            //return Auth::user()->hasRole('Founder');
            return in_array(Auth::user()->email, [
                'chenraygogo@gmail.com'
            ]);
        });
    }
}
