<?php

use Illuminate\Support\Facades\Route;

Route::get('calculator', function(){
    $qm = app(\Sujit\QueueManager\Services\QueueManager::class);
    for($i = 0; $i <= 1000; $i++)
    {
        $qm->add(new \App\Jobs\TestJob($i));
    }
    echo 'Hello from the calculator package!';
});
