<?php

namespace Rocketfy\BacketfyHorizon\Contracts;

interface Pausable
{
    /**
     * Pause the process.
     *
     * @return void
     */
    public function pause();

    /**
     * Instruct the process to continue working.
     *
     * @return void
     */
    public function continue();
}
