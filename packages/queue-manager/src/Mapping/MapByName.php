<?php

namespace Sujit\QueueManager\Mapping;

class MapByName
{
    public function map(string $commandClassName): MapItem
    {
        return new MapItem($commandClassName . 'Handler');
    }
}
