<?php


namespace Sujit\QueueManager\Http\Middlewares;


interface Middleware
{
    /**
     * @param object $command
     * @param callable $next
     * @return mixed
     */
    public function execute(object $command, callable $next);
}
