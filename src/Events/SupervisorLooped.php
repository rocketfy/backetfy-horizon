<?php

namespace Rocketfy\BacketfyHorizon\Events;

use Rocketfy\BacketfyHorizon\Supervisor;

class SupervisorLooped
{
    /**
     * The supervisor instance.
     *
     * @var \Rocketfy\BacketfyHorizon\Supervisor
     */
    public $supervisor;

    /**
     * Create a new event instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\Supervisor  $supervisor
     * @return void
     */
    public function __construct(Supervisor $supervisor)
    {
        $this->supervisor = $supervisor;
    }
}
