<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class LogStatusCommand extends Command
{
    protected $signature = 'queue-manager:log-status {hours=24}';
    protected $description = 'Logs queue status over the specified period (default 24 hours)';

    public function handle()
    {
        $hours = intval($this->argument('hours'));
        app(QueueManager::class)->logStatus($hours);
    }
}
