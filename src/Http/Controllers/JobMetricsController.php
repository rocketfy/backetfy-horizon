<?php

namespace Rocketfy\BacketfyHorizon\Http\Controllers;

use Rocketfy\BacketfyHorizon\Contracts\MetricsRepository;

class JobMetricsController extends Controller
{
    /**
     * The metrics repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\MetricsRepository
     */
    public $metrics;

    /**
     * Create a new controller instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\MetricsRepository  $metrics
     * @return void
     */
    public function __construct(MetricsRepository $metrics)
    {
        parent::__construct();

        $this->metrics = $metrics;
    }

    /**
     * Get all of the measured jobs.
     *
     * @return array
     */
    public function index()
    {
        return $this->metrics->measuredJobs();
    }

    /**
     * Get metrics for a given job.
     *
     * @param  string  $slug
     * @return \Illuminate\Support\Collection
     */
    public function show($slug)
    {
        return collect($this->metrics->snapshotsForJob($slug))->map(function ($record) {
            $record->runtime = round($record->runtime / 1000, 3);
            $record->throughput = (int) $record->throughput;

            return $record;
        });
    }
}
