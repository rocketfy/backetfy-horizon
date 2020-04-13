<?php

namespace Rocketfy\BacketfyHorizon\Events;

use Rocketfy\BacketfyHorizon\WorkerProcess;

class UnableToLaunchProcess
{
    /**
     * The worker process instance.
     *
     * @var \Rocketfy\BacketfyHorizon\WorkerProcess
     */
    public $process;

    /**
     * Create a new event instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\WorkerProcess  $process
     * @return void
     */
    public function __construct(WorkerProcess $process)
    {
        $this->process = $process;
    }
}
