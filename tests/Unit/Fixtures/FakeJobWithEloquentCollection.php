<?php

namespace Rocketfy\BacketfyHorizon\Tests\Unit\Fixtures;

class FakeJobWithEloquentCollection
{
    public $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }
}
