<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Fakes;

use Rocketfy\BacketfyHorizon\Supervisor;

class SupervisorWithFakeExit extends Supervisor
{
    public $exited = false;

    /**
     * End the current PHP process.
     *
     * @param  int  $status
     * @return void
     */
    protected function exitProcess($status = 0)
    {
        $this->exited = true;
    }
}
