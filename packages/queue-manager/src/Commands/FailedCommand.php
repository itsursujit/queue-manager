<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class FailedCommand extends Command
{
    protected $name = 'queue-manager:failed';
    protected $description = 'Lists failed jobs';

    public function handle()
    {
        $jobs = app(QueueManager::class)->allFailed();
        $table = app(MakeTable::class)->fromJobs($jobs);
        if (count($table)) {
            $this->table(array_keys($table[0]), $table);
        } else {
            $this->info('No failed jobs found');
        }
    }
}
