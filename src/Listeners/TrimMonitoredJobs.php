<?php

namespace Rocketfy\BacketfyHorizon\Listeners;

use Cake\Chronos\Chronos;
use Rocketfy\BacketfyHorizon\Contracts\JobRepository;
use Rocketfy\BacketfyHorizon\Events\MasterSupervisorLooped;

class TrimMonitoredJobs
{
    /**
     * The last time the monitored jobs were trimmed.
     *
     * @var \Cake\Chronos\Chronos
     */
    public $lastTrimmed;

    /**
     * How many minutes to wait in between each trim.
     *
     * @var int
     */
    public $frequency = 1440;

    /**
     * Handle the event.
     *
     * @param  \Rocketfy\BacketfyHorizon\Events\MasterSupervisorLooped  $event
     * @return void
     */
    public function handle(MasterSupervisorLooped $event)
    {
        if (! isset($this->lastTrimmed)) {
            $this->frequency = max(1, intdiv(
                config('horizon.trim.monitored', 10080), 12
            ));

            $this->lastTrimmed = Chronos::now()->subMinutes($this->frequency + 1);
        }

        if ($this->lastTrimmed->lte(Chronos::now()->subMinutes($this->frequency))) {
            app(JobRepository::class)->trimMonitoredJobs();

            $this->lastTrimmed = Chronos::now();
        }
    }
}
