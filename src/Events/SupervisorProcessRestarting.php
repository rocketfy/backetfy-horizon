<?php

namespace Rocketfy\BacketfyHorizon\Events;

use Rocketfy\BacketfyHorizon\SupervisorProcess;

class SupervisorProcessRestarting
{
    /**
     * The supervisor process instance.
     *
     * @var \Rocketfy\BacketfyHorizon\SupervisorProcess
     */
    public $process;

    /**
     * Create a new event instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\SupervisorProcess  $process
     * @return void
     */
    public function __construct(SupervisorProcess $process)
    {
        $this->process = $process;
    }
}
