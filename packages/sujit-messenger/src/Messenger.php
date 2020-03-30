<?php


namespace Sujit\Messenger;


use Sujit\Messenger\Drivers\FacebookDriver;
use Sujit\Messenger\Drivers\LongcodeDriver;
use Sujit\Messenger\Drivers\ShortcodeDriver;
use Sujit\Messenger\Drivers\TollfreeDriver;
use Sujit\Messenger\Drivers\VirtualNumberDriver;
use Sujit\Messenger\Drivers\WhatsappDriver;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Manager;

class Messenger extends Manager
{

    public function channel($messageType = null)
    {
        return $this->driver($messageType);
    }

    public function createFacebookDriver()
    {
        return new FacebookDriver();
    }

    public function createLongcodeDriver()
    {
        return new LongcodeDriver();
    }

    public function createShortcodeDriver()
    {
        return new ShortcodeDriver();
    }

    public function createTollfreeDriver()
    {
        return new TollfreeDriver();
    }

    public function createVirtualNumberDriver()
    {
        return new VirtualNumberDriver();
    }

    public function createWhatsappDriver()
    {
        return new WhatsappDriver();
    }

    /**
     * @inheritDoc
     */
    public function getDefaultDriver()
    {
        return config('messenger.default');
    }
}
