<?php

namespace Rocketfy\BacketfyHorizon\SupervisorCommands;

use Rocketfy\BacketfyHorizon\Contracts\Pausable;

class Pause
{
    /**
     * Process the command.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\Pausable  $pausable
     * @return void
     */
    public function process(Pausable $pausable)
    {
        $pausable->pause();
    }
}
