<?php

namespace Sujit\QueueManager;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Sujit\QueueManager\Http\Middlewares\CommandHandlerMiddleware;
use Sujit\QueueManager\Mapping\MapItem;
use Sujit\QueueManager\Mapping\Mapping;
use Sujit\QueueManager\Services\CommandBus;

class QueueManagerServiceProvider extends ServiceProvider
{
    protected $commands = [
        Commands\ClearFailedCommand::class,
        Commands\DaemonCommand::class,
        Commands\DeleteCommand::class,
        Commands\DumpCommand::class,
        Commands\FailedCommand::class,
        Commands\ListCommand::class,
        Commands\LogStatusCommand::class,
        Commands\PauseCommand::class,
        Commands\ProcessCommand::class,
        Commands\ResumeCommand::class,
        Commands\RetryCommand::class,
        Commands\StatusCommand::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/queue-manager.php', 'queue_manager');
        $this->app->bind(Mapping::class, function () {
            $map = [];
            foreach (config('queue_manager.map', []) as $command => $handler) {
                $map[$command] = is_array($handler) ? new MapItem($handler[0], $handler[1]) : new MapItem($handler);
            }
            return new Mapping($map);
        });
        $this->app->singleton(CommandBus::class, function (Application $app) {
            $middleware = [];
            foreach (config('queue_manager.middleware', []) as $class) {
                $middleware[] = $app->make($class);
            }
            $middleware[] = $app->make(CommandHandlerMiddleware::class);
            return new CommandBus(...$middleware);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands($this->commands);
        $this->publishes([__DIR__.'/config/queue-manager.php' => config_path('queue_manager.php')]);
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'Sujit\QueueManager');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
