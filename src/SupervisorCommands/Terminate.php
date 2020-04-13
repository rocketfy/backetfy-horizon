<?php

namespace Rocketfy\BacketfyHorizon\SupervisorCommands;

use Rocketfy\BacketfyHorizon\Contracts\Terminable;

class Terminate
{
    /**
     * Process the command.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\Terminable  $terminable
     * @param  array  $options
     * @return void
     */
    public function process(Terminable $terminable, array $options)
    {
        $terminable->terminate($options['status'] ?? 0);
    }
}
