<?php

namespace App\Providers;

use App\Listeners\MatchedRouteListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as EventServiceProviderAlias;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;

class MessengerRequestServiceProvider extends EventServiceProviderAlias
{
    protected $listen = [
        RouteMatched::class => [
            MatchedRouteListener::class
        ]
    ];
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
        parent::boot();
    }
}
