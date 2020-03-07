<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Jobs\QueuedJobRepo;

class RetryCommand extends Command
{
    protected $signature = 'queue-manager:retry {id}';
    protected $description = 'Retries the specified job';

    public function handle()
    {
        $id = $this->argument('id');
        $job = app(QueuedJobRepo::class)->findById($id);
        if (!$job) {
            $this->warn("Job id:{$id} not found");
            return;
        }
        if (!$job->failed()) {
            $this->warn('Job has not failed! No change made.');
            return;
        }
        $job->retry();
        app(QueuedJobRepo::class)->persist($job);
        $this->info('Job will be retried, see queue-manager:list for status');
    }
}
