<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Fixtures;

use Rocketfy\BacketfyHorizon\SupervisorProcess;

class SupervisorProcessWithFakeRestart extends SupervisorProcess
{
    public $wasRestarted = false;

    public function restart()
    {
        $this->wasRestarted = true;
    }
}
