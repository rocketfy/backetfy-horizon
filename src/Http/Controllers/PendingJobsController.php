<?php

namespace Rocketfy\BacketfyHorizon\Http\Controllers;

use Illuminate\Http\Request;
use Rocketfy\BacketfyHorizon\Contracts\JobRepository;

class PendingJobsController extends Controller
{
    /**
     * The job repository implementation.
     *
     * @var \Rocketfy\BacketfyHorizon\Contracts\JobRepository
     */
    public $jobs;

    /**
     * Create a new controller instance.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\JobRepository  $jobs
     * @return void
     */
    public function __construct(JobRepository $jobs)
    {
        parent::__construct();

        $this->jobs = $jobs;
    }

    /**
     * Get all of the recent jobs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index(Request $request)
    {
        $jobs = $this->jobs->getPending($request->query('starting_at', -1))->map(function ($job) {
            $job->payload = json_decode($job->payload);

            return $job;
        })->values();

        return [
            'jobs' => $jobs,
            'total' => $this->jobs->countRecent(),
        ];
    }

    /**
     * Decode the given job.
     *
     * @param  object  $job
     * @return object
     */
    protected function decode($job)
    {
        $job->payload = json_decode($job->payload);

        return $job;
    }
}
