<?php


namespace Sujit\Messenger;


use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider;
use Sujit\Messenger\Events\MessageCallbackReceivedEvent;
use Sujit\Messenger\Events\MessageReceivedEvent;
use Sujit\Messenger\Events\MessageSentEvent;
use Sujit\Messenger\Listeners\MessageCallbackReceivedListener;
use Sujit\Messenger\Listeners\MessageReceivedListener;
use Sujit\Messenger\Listeners\MessageSentListener;

class MessengerEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        MessageReceivedEvent::class => [
            MessageReceivedListener::class,
        ],
        MessageCallbackReceivedEvent::class => [
            MessageCallbackReceivedListener::class,
        ],
        MessageSentEvent::class => [
            MessageSentListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
