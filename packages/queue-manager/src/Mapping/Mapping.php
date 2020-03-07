<?php

namespace Sujit\QueueManager\Mapping;

class Mapping
{
    /** @var MapItem[] */
    private $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function map(string $commandClassName): ?MapItem
    {
        return $this->map[$commandClassName] ?? null;
    }
}
