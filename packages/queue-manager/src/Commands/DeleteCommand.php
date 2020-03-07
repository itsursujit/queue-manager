<?php

namespace Sujit\QueueManager\Commands;

use Illuminate\Console\Command;
use Sujit\QueueManager\Jobs\QueuedJobRepo;

class DeleteCommand extends Command
{
    protected $signature = 'queue-manager:delete {id}';
    protected $description = 'Deletes a specified job';

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
        if ($this->confirm("Proceed with delete?")) {
            app(QueuedJobRepo::class)->delete($id);
        }
    }
}
