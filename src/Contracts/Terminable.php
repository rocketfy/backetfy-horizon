<?php

namespace Rocketfy\BacketfyHorizon\Contracts;

interface Terminable
{
    /**
     * Terminate the process.
     *
     * @param  int  $status
     * @return void
     */
    public function terminate($status = 0);
}
