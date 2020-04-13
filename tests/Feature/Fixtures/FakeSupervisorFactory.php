<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Fixtures;

use Rocketfy\BacketfyHorizon\SupervisorFactory;
use Rocketfy\BacketfyHorizon\SupervisorOptions;
use Rocketfy\BacketfyHorizon\Tests\Feature\Fakes\SupervisorWithFakeMonitor;

class FakeSupervisorFactory extends SupervisorFactory
{
    public $supervisor;

    public function make(SupervisorOptions $options)
    {
        return $this->supervisor = new SupervisorWithFakeMonitor($options);
    }
}
