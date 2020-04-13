<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Events\SupervisorLooped;

class MonitorSupervisorMemory
{
    /**
     * Handle the event.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\SupervisorLooped  $event
     * @return void
     */
    public function handle(SupervisorLooped $event)
    {
        $supervisor = $event->supervisor;

        if ($supervisor->memoryUsage() > $supervisor->options->memory) {
            $supervisor->terminate(12);
        }
    }
}
