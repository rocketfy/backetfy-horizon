<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Contracts\MasterSupervisorRepository;
use Rocketfy\BacketfyHorizon\Contracts\SupervisorRepository;
use Rocketfy\BacketfyHorizon\Events\MasterSupervisorLooped;

class ExpireSupervisors
{
    /**
     * Handle the event.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\MasterSupervisorLooped  $event
     * @return void
     */
    public function handle(MasterSupervisorLooped $event)
    {
        app(MasterSupervisorRepository::class)->flushExpired();

        app(SupervisorRepository::class)->flushExpired();
    }
}
