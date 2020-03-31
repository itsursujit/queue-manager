<?php


namespace Sujit\Messenger\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class BaseEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $vendor;
    public $service;
    public $payload;
    public $response;

    public function __construct($user, $vendor, $service, $payload, $response)
    {

        $this->user = $user;
        $this->vendor = $vendor;
        $this->service = $service;
        $this->payload = $payload;
        $this->response = $response;
    }
}
