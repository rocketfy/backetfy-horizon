<?php

namespace Rocketfy\BacketfyHorizon\Http\Controllers;

use Rocketfy\BacketfyHorizon\Contracts\WorkloadRepository;

class WorkloadController extends Controller
{
    /**
     * Get the current queue workload for the application.
     *
     * @param  \Rocketfy\BacketfyHorizon\Contracts\WorkloadRepository  $workload
     * @return array
     */
    public function index(WorkloadRepository $workload)
    {
        return collect($workload->get())->sortBy('name')->values()->toArray();
    }
}
