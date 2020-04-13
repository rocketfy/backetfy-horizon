<?php

namespace Rocketfy\BacketfyHorizon;

class SupervisorFactory
{
    /**
     * Create a new supervisor instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\SupervisorOptions  $options
     * @return \Rocketfy\BacketfyHorizon\Supervisor
     */
    public function make(SupervisorOptions $options)
    {
        return new Supervisor($options);
    }
}
