<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Contracts\JobRepository;
use Rocketfy\BacketfyHorizon\Events\JobPushed;

class StoreJob
{
    /**
     * The job repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\JobRepository
     */
    public $jobs;

    /**
     * Create a new listener instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\JobRepository  $jobs
     * @return void
     */
    public function __construct(JobRepository $jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * Handle the event.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\JobPushed  $event
     * @return void
     */
    public function handle(JobPushed $event)
    {
        $this->jobs->pushed(
            $event->connectionName, $event->queue, $event->payload
        );
    }
}
