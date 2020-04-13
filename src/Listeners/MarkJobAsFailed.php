<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Contracts\JobRepository;
use Rocketfy\BacketfyHorizon\Events\JobFailed;

class MarkJobAsFailed
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
     * @param  \Rocketfy\BacketfyHorizon\Events\JobFailed  $event
     * @return void
     */
    public function handle(JobFailed $event)
    {
        $this->jobs->failed(
            $event->exception, $event->connectionName,
            $event->queue, $event->payload
        );
    }
}
