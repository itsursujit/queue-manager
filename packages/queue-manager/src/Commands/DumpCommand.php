<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Jobs\QueuedJobRepo;

class DumpCommand extends Command
{
    protected $signature = 'queue-manager:dump {id}';
    protected $description = 'Shows the content of the specified job';

    public function handle()
    {
        $id = $this->argument('id');
        $job = app(QueuedJobRepo::class)->findById($id);
        if (!$job) {
            $this->warn("Job id:{$id} not found");
            return;
        }
        $dump = new Dump($this->output);
        $dump->toOutput($job);
    }
}
