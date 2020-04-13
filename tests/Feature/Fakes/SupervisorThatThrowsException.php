<?php

namespace Rocketfy\BacketfyHorizon\Tests\Feature\Fakes;

use Exception;
use Rocketfy\BacketfyHorizon\Supervisor;

class SupervisorThatThrowsException extends Supervisor
{
    /**
     * Persist information about this supervisor instance.
     *
     * @return void
     * @throws \Exception
     */
    public function persist()
    {
        throw new Exception;
    }
}
