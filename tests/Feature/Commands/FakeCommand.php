<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Commands;

use Rocketfy\BacketfyHorizon\Supervisor;

class FakeCommand
{
    public $processCount = 0;
    public $supervisor;
    public $options;

    public function process(Supervisor $supervisor, array $options)
    {
        $this->processCount++;
        $this->supervisor = $supervisor;
        $this->options = $options;
    }
}
