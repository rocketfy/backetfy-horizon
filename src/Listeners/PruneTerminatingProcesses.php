<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Events\SupervisorLooped;

class PruneTerminatingProcesses
{
    /**
     * Handle the event.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\SupervisorLooped  $event
     * @return void
     */
    public function handle(SupervisorLooped $event)
    {
        $event->supervisor->pruneTerminatingProcesses();
    }
}
