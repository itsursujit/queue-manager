<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Routing\Events\RouteMatched;

class MatchedRouteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param RouteMatched $event
     * @return void
     */
    public function handle(RouteMatched $event)
    {
        // dd($event->route);
    }
}
