<?php

namespace Rocketfy\BacketfyHorizon\SupervisorCommands;

use Rocketfy\BacketfyHorizon\Contracts\Restartable;

class Restart
{
    /**
     * Process the command.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\Restartable  $restartable
     * @return void
     */
    public function process(Restartable $restartable)
    {
        $restartable->restart();
    }
}
