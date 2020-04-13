<?php

namespace Rocketfy\BacketfyHorizon\SupervisorCommands;

use Rocketfy\BacketfyHorizon\Supervisor;

class Scale
{
    /**
     * Process the command.
     *
     * @param  \Rocketfy\BacketfyHorizon\Supervisor  $supervisor
     * @param  array  $options
     * @return void
     */
    public function process(Supervisor $supervisor, array $options)
    {
        $supervisor->scale($options['scale']);
    }
}
