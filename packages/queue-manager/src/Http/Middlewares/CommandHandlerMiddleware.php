<?php

namespace Sujit\QueueManager\Http\Middlewares;

use Psr\Container\ContainerInterface;
use RuntimeException;
use Sujit\QueueManager\Mapping\MapByName;
use Sujit\QueueManager\Mapping\Mapping;

/**
 * Class CommandHandlerMiddleware
 * @package Sujit\QueueManager\Http\Middlewares
 */
class CommandHandlerMiddleware implements Middleware
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Mapping
     */
    private $mapping;
    /**
     * @var MapByName
     */
    private $mapByName;

    /**
     * CommandHandlerMiddleware constructor.
     * @param ContainerInterface $container
     * @param Mapping $mapping
     * @param MapByName $mapByName
     */
    public function __construct(ContainerInterface $container, Mapping $mapping, MapByName $mapByName)
    {
        $this->container = $container;
        $this->mapping = $mapping;
        $this->mapByName = $mapByName;
    }

    /**
     * @param object $command
     * @param callable $next
     * @return mixed
     */
    public function execute(object $command, callable $next)
    {
        $commandClassName = get_class($command);
        $map = $this->mapping->map($commandClassName) ?: $this->mapByName->map($commandClassName);
        $handler = $this->container->get($map->handlerClass());
        if (!is_callable([$handler, $map->handlerMethod()])) {
            throw new RuntimeException('Cannot call ' . $map->handlerMethod() . ' on handler class ' . get_class($handler));
        }
        return $handler->{$map->handlerMethod()}($command);
    }
}
