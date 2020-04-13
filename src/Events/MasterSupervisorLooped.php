<?php

namespace Rocketfy\BacketfyHorizon\Events;

use Rocketfy\BacketfyHorizon\MasterSupervisor;

class MasterSupervisorLooped
{
    /**
     * The master supervisor instance.
     *
     * @var \Rocketfy\BacketfyHorizon\MasterSupervisor
     */
    public $master;

    /**
     * Create a new event instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\MasterSupervisor  $master
     * @return void
     */
    public function __construct(MasterSupervisor $master)
    {
        $this->master = $master;
    }
}
