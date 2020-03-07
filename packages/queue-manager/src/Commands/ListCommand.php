<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Services\QueueManager;

class ListCommand extends Command
{
    protected $signature = 'queue-manager:list {days=7}';

    protected $description = 'Lists recent jobs within the specified number of days';

    public function handle()
    {
        $days = $this->argument('days');
        $jobs = app(QueueManager::class)->recent($days);
        $table = app(MakeTable::class)->fromJobs($jobs);
        if (count($table)) {
            $this->table(array_keys($table[0]), $table);
        } else {
            $this->info('No jobs found');
        }
    }
}
