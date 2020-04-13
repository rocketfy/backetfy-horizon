<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Commands;

use Rocketfy\BacketfyHorizon\MasterSupervisor;

class FakeMasterCommand
{
    public $processCount = 0;
    public $master;
    public $options;

    public function process(MasterSupervisor $master, array $options)
    {
        $this->processCount++;
        $this->master = $master;
        $this->options = $options;
    }
}
