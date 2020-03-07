<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class ProcessCommand extends Command
{
    protected $name = 'queue-manager:process';

    protected $description = 'Processes all Queue Manager jobs';

    public function handle()
    {
        app(QueueManager::class)->process();
    }
}
