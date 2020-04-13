<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Rocketfy\BacketfyHorizon\Contracts\MetricsRepository;
use Rocketfy\BacketfyHorizon\Events\JobDeleted;
use Rocketfy\BacketfyHorizon\Stopwatch;

class UpdateJobMetrics
{
    /**
     * The metrics repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\MetricsRepository
     */
    public $metrics;

    /**
     * The stopwatch instance.
     *
     * @var \Rocketfy\BacketfyHorizon\Stopwatch
     */
    public $watch;

    /**
     * Create a new listener instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\MetricsRepository  $metrics
     * @param  \Rocketfy\BacketfyHorizon\Stopwatch  $watch
     * @return void
     */
    public function __construct(MetricsRepository $metrics, Stopwatch $watch)
    {
        $this->watch = $watch;
        $this->metrics = $metrics;
    }

    /**
     * Stop gathering metrics for a job.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\JobDeleted  $event
     * @return void
     */
    public function handle(JobDeleted $event)
    {
        if ($event->job->hasFailed()) {
            return;
        }

        $time = $this->watch->check($event->payload->id());

        $this->metrics->incrementQueue(
            $event->job->getQueue(), $time
        );

        $this->metrics->incrementJob(
            $event->payload->displayName(), $time
        );
    }
}
