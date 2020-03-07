<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class ClearFailedCommand extends Command
{
    protected $name = 'queue-manager:clear-jobs';

    protected $description = 'Clears all Queue Manager failed jobs';

    public function handle()
    {
        app(QueueManager::class)->clearFailed();
        $this->info('All failed jobs cleared');
    }
}
