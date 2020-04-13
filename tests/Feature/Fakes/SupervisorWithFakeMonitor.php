<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Fakes;

use Rocketfy\BacketfyHorizon\Supervisor;

class SupervisorWithFakeMonitor extends Supervisor
{
    public $monitoring = false;

    /**
     * {@inheritdoc}
     */
    public function monitor()
    {
        $this->monitoring = true;
    }
}
