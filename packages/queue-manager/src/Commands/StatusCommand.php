<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class StatusCommand extends Command
{
    protected $signature = 'queue-manager:status {hours=24}';
    protected $description = 'Displays queue status over the specified period (default 24 hours)';

    public function handle()
    {
        $hours = intval($this->argument('hours'));
        $this->info(app(QueueManager::class)->status($hours));
    }
}
