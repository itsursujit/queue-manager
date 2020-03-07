<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class DaemonCommand extends Command
{
    protected $signature = 'queue-manager:daemon {seconds=50}';
    protected $description = 'Runs process command repeatedly for the period required';

    public function handle()
    {
        $seconds = intval($this->argument('seconds'));
        app(QueueManager::class)->daemon($seconds);
    }
}
